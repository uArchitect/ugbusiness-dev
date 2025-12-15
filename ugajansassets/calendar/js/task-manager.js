/**
 * Task Management System
 * Scalable architecture for employee task management
 * 
 * @class TaskManager
 * @version 1.0.0
 */

class TaskManager {
    constructor(containerId, config = {}) {
        this.container = document.getElementById(containerId);
        if (!this.container) {
            throw new Error(`Container with id "${containerId}" not found`);
        }

        this.config = this._mergeConfig(config);
        this.state = {
            currentUser: null,
            currentView: 'day',
            selectedDate: new Date(),
            tasks: new Map(),
            filters: {
                employee: null,
                status: null,
                dateRange: null
            }
        };

        this.dataService = new TaskDataService(this.config.apiEndpoint);
        this.viewManager = new ViewManager(this);
        this.eventEmitter = new EventEmitter();
        this.cache = new CacheManager();

        this._init();
    }

    _mergeConfig(config) {
        return {
            apiEndpoint: config.apiEndpoint || '/api/tasks',
            enableCaching: config.enableCaching !== false,
            cacheTTL: config.cacheTTL || 300000, // 5 minutes
            defaultView: config.defaultView || 'day',
            roles: config.roles || ['employee', 'manager', 'admin'],
            ...config
        };
    }

    async _init() {
        await this._loadUser();
        this._setupEventListeners();
        this.viewManager.render();
        this.eventEmitter.emit('initialized');
    }

    async _loadUser() {
        // In production, this would fetch from API
        this.state.currentUser = {
            id: 'user-1',
            name: 'Test User',
            role: 'manager',
            permissions: ['view_all', 'edit_all']
        };
    }

    _setupEventListeners() {
        // Listen for date changes
        this.eventEmitter.on('dateChanged', (date) => {
            this.state.selectedDate = date;
            this.loadTasks();
        });

        // Listen for filter changes
        this.eventEmitter.on('filterChanged', (filters) => {
            this.state.filters = { ...this.state.filters, ...filters };
            this.loadTasks();
        });
    }

    // Public API
    async loadTasks() {
        const cacheKey = this._getCacheKey();
        
        if (this.config.enableCaching) {
            const cached = this.cache.get(cacheKey);
            if (cached) {
                this.state.tasks = cached;
                this.viewManager.update();
                return;
            }
        }

        try {
            const tasks = await this.dataService.fetchTasks({
                date: this.state.selectedDate,
                employee: this.state.filters.employee,
                role: this.state.currentUser.role
            });

            this.state.tasks = this._processTasks(tasks);
            
            if (this.config.enableCaching) {
                this.cache.set(cacheKey, this.state.tasks);
            }

            this.viewManager.update();
            this.eventEmitter.emit('tasksLoaded', this.state.tasks);
        } catch (error) {
            this.eventEmitter.emit('error', error);
            console.error('Failed to load tasks:', error);
        }
    }

    _processTasks(tasks) {
        const taskMap = new Map();
        
        tasks.forEach(task => {
            const dateKey = this._getDateKey(task.start);
            if (!taskMap.has(dateKey)) {
                taskMap.set(dateKey, []);
            }
            taskMap.get(dateKey).push(task);
        });

        return taskMap;
    }

    _getDateKey(date) {
        const d = new Date(date);
        return `${d.getFullYear()}-${d.getMonth()}-${d.getDate()}`;
    }

    _getCacheKey() {
        return `tasks-${this.state.selectedDate.getTime()}-${this.state.filters.employee || 'all'}`;
    }

    async createTask(taskData) {
        try {
            const task = await this.dataService.createTask(taskData);
            this.state.tasks = this._addTaskToMap(task);
            this.cache.invalidate();
            this.viewManager.update();
            this.eventEmitter.emit('taskCreated', task);
            return task;
        } catch (error) {
            this.eventEmitter.emit('error', error);
            throw error;
        }
    }

    async updateTask(taskId, updates) {
        try {
            const task = await this.dataService.updateTask(taskId, updates);
            this.state.tasks = this._updateTaskInMap(task);
            this.cache.invalidate();
            this.viewManager.update();
            this.eventEmitter.emit('taskUpdated', task);
            return task;
        } catch (error) {
            this.eventEmitter.emit('error', error);
            throw error;
        }
    }

    async deleteTask(taskId) {
        try {
            await this.dataService.deleteTask(taskId);
            this.state.tasks = this._removeTaskFromMap(taskId);
            this.cache.invalidate();
            this.viewManager.update();
            this.eventEmitter.emit('taskDeleted', taskId);
        } catch (error) {
            this.eventEmitter.emit('error', error);
            throw error;
        }
    }

    _addTaskToMap(task) {
        const newMap = new Map(this.state.tasks);
        const dateKey = this._getDateKey(task.start);
        const tasks = newMap.get(dateKey) || [];
        tasks.push(task);
        newMap.set(dateKey, tasks);
        return newMap;
    }

    _updateTaskInMap(task) {
        const newMap = new Map(this.state.tasks);
        const dateKey = this._getDateKey(task.start);
        const tasks = newMap.get(dateKey) || [];
        const index = tasks.findIndex(t => t.id === task.id);
        if (index !== -1) {
            tasks[index] = task;
            newMap.set(dateKey, tasks);
        }
        return newMap;
    }

    _removeTaskFromMap(taskId) {
        const newMap = new Map(this.state.tasks);
        for (const [dateKey, tasks] of newMap.entries()) {
            const filtered = tasks.filter(t => t.id !== taskId);
            if (filtered.length !== tasks.length) {
                newMap.set(dateKey, filtered);
                break;
            }
        }
        return newMap;
    }

    setView(viewType) {
        this.state.currentView = viewType;
        this.viewManager.setView(viewType);
        this.eventEmitter.emit('viewChanged', viewType);
    }

    setFilter(filterType, value) {
        this.state.filters[filterType] = value;
        this.eventEmitter.emit('filterChanged', { [filterType]: value });
    }

    setDate(date) {
        this.state.selectedDate = new Date(date);
        this.eventEmitter.emit('dateChanged', this.state.selectedDate);
    }

    canEdit(task) {
        if (this.state.currentUser.role === 'admin') return true;
        if (this.state.currentUser.role === 'manager') return true;
        return task.employeeId === this.state.currentUser.id;
    }

    canViewAll() {
        return ['manager', 'admin'].includes(this.state.currentUser.role);
    }

    on(event, callback) {
        this.eventEmitter.on(event, callback);
    }

    off(event, callback) {
        this.eventEmitter.off(event, callback);
    }
}

/**
 * Task Data Service
 * Handles all API communication
 */
class TaskDataService {
    constructor(endpoint) {
        this.endpoint = endpoint;
    }

    async fetchTasks(params) {
        // In production, this would be a real API call
        const query = new URLSearchParams({
            date: params.date.toISOString(),
            ...(params.employee && { employee: params.employee }),
            role: params.role
        });

        const response = await fetch(`${this.endpoint}?${query}`);
        if (!response.ok) {
            throw new Error(`Failed to fetch tasks: ${response.statusText}`);
        }

        return response.json();
    }

    async createTask(taskData) {
        const response = await fetch(this.endpoint, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(taskData)
        });

        if (!response.ok) {
            throw new Error(`Failed to create task: ${response.statusText}`);
        }

        return response.json();
    }

    async updateTask(taskId, updates) {
        const response = await fetch(`${this.endpoint}/${taskId}`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(updates)
        });

        if (!response.ok) {
            throw new Error(`Failed to update task: ${response.statusText}`);
        }

        return response.json();
    }

    async deleteTask(taskId) {
        const response = await fetch(`${this.endpoint}/${taskId}`, {
            method: 'DELETE'
        });

        if (!response.ok) {
            throw new Error(`Failed to delete task: ${response.statusText}`);
        }
    }
}

/**
 * View Manager
 * Handles different view types (day, week, month, employee)
 */
class ViewManager {
    constructor(taskManager) {
        this.taskManager = taskManager;
        this.views = {
            day: new DayView(taskManager),
            week: new WeekView(taskManager),
            month: new MonthView(taskManager),
            employee: new EmployeeView(taskManager)
        };
        this.currentView = null;
    }

    render() {
        const viewType = this.taskManager.state.currentView;
        this.setView(viewType);
    }

    setView(viewType) {
        if (this.currentView) {
            this.currentView.destroy();
        }

        this.currentView = this.views[viewType];
        if (this.currentView) {
            this.currentView.render();
        }
    }

    update() {
        if (this.currentView) {
            this.currentView.update();
        }
    }
}

/**
 * Base View Class
 */
class BaseView {
    constructor(taskManager) {
        this.taskManager = taskManager;
        this.container = null;
    }

    render() {
        throw new Error('render() must be implemented');
    }

    update() {
        throw new Error('update() must be implemented');
    }

    destroy() {
        if (this.container) {
            this.container.innerHTML = '';
        }
    }
}

/**
 * Day View
 */
class DayView extends BaseView {
    render() {
        // Implementation for day view
        console.log('Rendering day view');
    }

    update() {
        // Update day view with latest tasks
        console.log('Updating day view');
    }
}

/**
 * Week View
 */
class WeekView extends BaseView {
    render() {
        // Implementation for week view
        console.log('Rendering week view');
    }

    update() {
        // Update week view with latest tasks
        console.log('Updating week view');
    }
}

/**
 * Month View
 */
class MonthView extends BaseView {
    render() {
        // Implementation for month view
        console.log('Rendering month view');
    }

    update() {
        // Update month view with latest tasks
        console.log('Updating month view');
    }
}

/**
 * Employee View (for managers)
 */
class EmployeeView extends BaseView {
    render() {
        // Implementation for employee overview view
        console.log('Rendering employee view');
    }

    update() {
        // Update employee view with latest tasks
        console.log('Updating employee view');
    }
}

/**
 * Cache Manager
 */
class CacheManager {
    constructor() {
        this.cache = new Map();
    }

    get(key) {
        const item = this.cache.get(key);
        if (!item) return null;

        if (Date.now() > item.expiry) {
            this.cache.delete(key);
            return null;
        }

        return item.data;
    }

    set(key, data, ttl = 300000) {
        this.cache.set(key, {
            data,
            expiry: Date.now() + ttl
        });
    }

    invalidate() {
        this.cache.clear();
    }

    clear() {
        this.cache.clear();
    }
}

// Export
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { TaskManager, TaskDataService, ViewManager };
}

