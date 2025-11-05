<div class="content-wrapper" style="background:url(<?=base_url("assets/wave-pattern-v1.svg")?>) center top / cover no-repeat, linear-gradient(180deg, rgba(3, 120, 124, 0.2) 0%, rgba(3, 120, 124, 0.8) 100%);">
<br>
<div style="display: flow;padding:20px;max-width:70%;min-height:350px;background:white;margin:auto;border-radius:10px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
    <input class="form-control" id="customtitle" type="text" value="Adsız Form" placeholder="Anket Adını Giriniz" style="border:0px;height:40px;padding:20px;font-size:25px!important;font-weight:bold;margin:10px;width:-webkit-fill-available;color:#727171;">
    
    <div id="question-cards-container">
        <!-- Dinamik olarak eklenecek soru kartları burada gösterilecek -->
    </div>

    <a href="#" style="margin-left:7px;font-weight:bold;color:rgb(3, 120, 124)" onclick="addNewQuestion()">
        <i class="fa fa-plus-circle"></i>
        Yeni Soru Oluştur
    </a>

    <div class="row">
        <div class="col p-2">
            <button class="btn btn-default text-left pt-3 pb-3" style="background:#e8f2f4;border:0.0625rem solid rgba(3, 120, 124, 0.6);width: -webkit-fill-available;" onclick="addOptionQuestion()">
                <span> <i class="far fa-circle" style="color:rgb(3, 120, 124)"></i> Seçenek</span>
            </button>
        </div>
        <div class="col p-2">
            <button class="btn btn-default text-left pt-3 pb-3" style="background:#e8f2f4;border:0.0625rem solid rgba(3, 120, 124, 0.6);width: -webkit-fill-available;" onclick="addTextQuestion()">
                <span> <i class="fa fa-edit" style="color:rgb(3, 120, 124)"></i> Metin</span>
            </button>
        </div>
        <div class="col p-2">
            <button class="btn btn-default text-left pt-3 pb-3" style="background:#e8f2f4;border:0.0625rem solid rgba(3, 120, 124, 0.6);width: -webkit-fill-available;" onclick="addRatingQuestion()">
                <span> <i class="far fa-thumbs-up" style="color:rgb(3, 120, 124)"></i> Değerlendirme</span>
            </button>
        </div>
    </div>

    <button class="btn btn-primary mt-3" style="margin-left:8px;" onclick="saveSurvey()">Anketi Kaydet</button>
    <pre id="json-output"></pre>
</div>
</div>
 
<script>
    let questionCounter = 0;

    function addNewQuestion() {
       
    }

    function addOptionQuestion() {
    const container = document.getElementById('question-cards-container');
    questionCounter++;

    const card = document.createElement('div');
    card.className = 'card custom-border mt-3';
    card.innerHTML = `
        <label for="option-question-${questionCounter}">Seçenek Sorusu:</label>
        <input type="text" id="option-question-${questionCounter}" class="form-control" placeholder="Soruyu yazınız">
        <div id="options-container-${questionCounter}">
            <div class="option-item" style="display:flex; align-items: center;">
                <div style="background: #ffffff; min-width: 20px; border: 1px solid #b9b9b9; border-radius: 50%; width:20px; height:20px; margin-top: 16px; margin-right: 9px;"></div>
                <input type="text" style="width:265px;" class="form-control mt-2" placeholder="Seçenek 1">
                <button class="btn-delete" style="margin-left: 5px; background: none; border: none; cursor: pointer;"><i class="fas fa-trash" style="color: red;"></i></button>
            </div>
            <div class="option-item" style="display:flex; align-items: center;">
                <div style="background: #ffffff; min-width: 20px; border: 1px solid #b9b9b9; border-radius: 50%; width:20px; height:20px; margin-top: 16px; margin-right: 9px;"></div>
                <input type="text" style="width:265px;" class="form-control mt-2" placeholder="Seçenek 2">
                <button class="btn-delete" style="margin-left: 5px; background: none; border: none; cursor: pointer;"><i class="fas fa-trash" style="color: red;"></i></button>
            </div>
        </div>
        <button class="btn mt-2" onclick="addOption(${questionCounter})" style="color: #18797b; display: flex; font-weight: 600;">Seçenek Ekle</button>
    `;

    container.appendChild(card);
 
    const deleteButtons = card.querySelectorAll('.btn-delete');
    deleteButtons.forEach((button) => {
        button.onclick = function() {
            const optionItem = button.parentElement;  
            optionItem.parentElement.removeChild(optionItem);  
        };
    });
}

    function addOption(counter) {
    const optionsContainer = document.getElementById(`options-container-${counter}`);
    const optionCount = optionsContainer.children.length + 1;

     
    const newOptionDiv = document.createElement('div');
    newOptionDiv.style.display = 'flex';
    newOptionDiv.style.alignItems = 'center';  

   
    const circleDiv = document.createElement('div');
    circleDiv.style.background = '#ffffff';
    circleDiv.style.minWidth = '20px';
    circleDiv.style.border = '1px solid #b9b9b9';
    circleDiv.style.borderRadius = '50%';
    circleDiv.style.width = '20px';
    circleDiv.style.height = '20px';
    circleDiv.style.marginTop = '16px';
    circleDiv.style.marginRight = '9px';

    
    const newOption = document.createElement('input');
    newOption.type = 'text';
    newOption.className = 'form-control mt-2';
    newOption.placeholder = `Seçenek ${optionCount}`;
    newOption.style.width = '265px';

    
    const deleteButton = document.createElement('button');
deleteButton.innerHTML = '<i class="fas fa-trash" style="color: red;    margin: 6px;"></i>';  
deleteButton.style.background = 'none';
deleteButton.style.border = 'none';
deleteButton.style.cursor = 'pointer';
deleteButton.title = 'Sil';  

     
    deleteButton.onclick = function() {
        optionsContainer.removeChild(newOptionDiv);
    };

     
    newOptionDiv.appendChild(circleDiv);
    newOptionDiv.appendChild(newOption);
    newOptionDiv.appendChild(deleteButton);

    
    optionsContainer.appendChild(newOptionDiv);
}



    function addTextQuestion() {
        const container = document.getElementById('question-cards-container');
        questionCounter++;

        const card = document.createElement('div');
        card.className = 'card custom-border mt-3';
        card.innerHTML = `
            <label for="text-question-${questionCounter}">Metin Sorusu:</label>
            <input type="text" id="text-question-${questionCounter}" class="form-control" placeholder="Soruyu yazınız">
        `;
        container.appendChild(card);
    }

    function addRatingQuestion() {
        const container = document.getElementById('question-cards-container');
        questionCounter++;

        const card = document.createElement('div');
        card.className = 'card custom-border mt-3';
        card.innerHTML = `
            <label for="rating-question-${questionCounter}">Değerlendirme Sorusu:</label>
            <input type="text" id="rating-question-${questionCounter}" class="form-control" placeholder="Soruyu yazınız">
            
            <label style="margin-top:5px;" for="max-rating-${questionCounter}">En fazla kaç puan:</label>
            <select id="max-rating-${questionCounter}" class="form-control" onchange="renderStars(${questionCounter}, this.value)">
                <option value="2">2 Yıldız</option>
                      <option value="3">3 Yıldız</option>
                            <option value="4">4 Yıldız</option>
                                  <option value="5" selected>5 Yıldız</option>
                                        <option value="6">6 Yıldız</option>
                                              <option value="7">7 Yıldız</option>
                                                <option value="8">8 Yıldız</option>
                                                  <option value="9">9 Yıldız</option>
                <option value="10">10 Yıldız</option>
            </select>

            <div id="star-rating-${questionCounter}" class="mt-2"></div>
        `;
        container.appendChild(card);

        
        renderStars(questionCounter, 5);
    }

    function renderStars(questionId, maxStars) {
        const starRatingContainer = document.getElementById(`star-rating-${questionId}`);
        starRatingContainer.innerHTML = '';  

        for (let i = 1; i <= maxStars; i++) {
            const star = document.createElement('i');
            star.classList.add('fa', 'fa-star-o', 'fa-2x');
            star.dataset.value = i;
            star.onclick = function() { handleStarClick(questionId, i); };
            starRatingContainer.appendChild(star);
        }
    }

    function handleStarClick(questionId, starValue) {
        const stars = document.querySelectorAll(`#star-rating-${questionId} i`);

        stars.forEach(star => {
            if (star.dataset.value <= starValue) {
                star.classList.remove('fa-star-o');
                star.classList.add('fa-star');
            } else {
                star.classList.remove('fa-star');
                star.classList.add('fa-star-o');
            }
        });
    }

    function saveSurvey() {
    const title = document.getElementById('customtitle').value;  
 
    const questions = [];
    for (let i = 1; i <= questionCounter; i++) {
        const optionQuestion = document.getElementById(`option-question-${i}`);
        const textQuestion = document.getElementById(`text-question-${i}`);
        const ratingQuestion = document.getElementById(`rating-question-${i}`);

        if (optionQuestion) {
            const options = [];
            const optionInputs = document.querySelectorAll(`#options-container-${i} input`);
            optionInputs.forEach(input => options.push(input.value));

            questions.push({
                type: 'option',
                question: optionQuestion.value,
                options: options
            });
        } else if (textQuestion) {
            questions.push({
                type: 'text',
                question: textQuestion.value
            });
        } else if (ratingQuestion) {
            const selectedStars = document.querySelectorAll(`#star-rating-${i} .fa-star`).length;
            const maxStars = document.getElementById(`max-rating-${i}`).value;

            questions.push({
                type: 'rating',
                question: ratingQuestion.value,
                maxStars: maxStars,
                selectedStars: selectedStars
            });
        }
    }

    const jsonData = JSON.stringify(questions, null, 2);

 
    
    const title0 = document.getElementById('customtitle').value;  
const questions0 = jsonData;  

console.log('Title:', title0);
console.log('Questions:', questions0);

 
fetch('<?= base_url("anket/save_survey") ?>', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({
        title: title0,
        questions: questions0
    })
})
.then(response => response.json())
.then(data => {
    alert(data.message); 
})
.catch(error => {
    console.error('Error:', error);
});
}
</script>
<style>
    .custom-border{
        border-top:3px solid red;
        padding:10px;
        background:#f5f5f5;
    }
    input{
       font-size:13px!important; 
    }

    .fa-star-o{
        color:#c4c4c4;
        margin-right: 10px;
    }
    </style>
 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
