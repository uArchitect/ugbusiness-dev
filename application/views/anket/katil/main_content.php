<div class="content-wrapper" style="background:url(<?= base_url("assets/wave-pattern-v1.svg") ?>) center top / cover no-repeat, linear-gradient(180deg, rgba(3, 120, 124, 0.2) 0%, rgba(3, 120, 124, 0.8) 100%);">
    <br>
    <div style="display: flow; padding:20px; max-width:70%; min-height:350px; background:white; margin:auto; border-radius:10px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
        <h1 class="mt-5"><?= $survey->title ?></h1>
        <form action="<?= base_url('anket/submit_answers') ?>" method="post">
            <input type="hidden" name="survey_id" value="<?= $survey->id ?>">
            <div class="list-group mt-3">
                <?php foreach ($questions as $question): ?>
                <div class="form-group">
                    <label><?= $question->question ?></label>
                    <?php if ($question->question_type == 'text'): ?>
                        <input type="text" name="answers[<?= $question->id ?>]" class="form-control" required>
                    <?php elseif ($question->question_type == 'option'): ?>
                        <div>
                            <?php
                            $options = json_decode($question->options);
                            if ($options):
                                foreach ($options as $option): ?>
                                    <div class="form-check">
                                        <input type="radio" name="answers[<?= $question->id ?>]" value="<?= $option ?>" class="form-check-input" required>
                                        <label class="form-check-label"><?= $option ?></label>
                                    </div>
                                <?php endforeach;
                            endif; ?>
                        </div>
                    <?php elseif ($question->question_type == 'rating'): ?><br>
                        <div class="rating">
                            <?php for ($i = $question->max_stars; $i >= 1; $i--): ?>
                                <input type="radio" name="answers[<?= $question->id ?>]" value="<?= $i ?>" id="star<?= $question->id ?>-<?= $i ?>" class="form-check-input" required>
                                <label for="star<?= $question->id ?>-<?= $i ?>" class="form-check-label" style="cursor: pointer;">★</label>
                            <?php endfor; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>

                <button type="submit" class="btn btn-primary">Cevapları Gönder</button>
            </div>
        </form>
    </div>
</div>

<style>
    .rating {
        direction: rtl;  
        display: inline-block;  
    }

    .rating input {
        display: none;  
    }

    .rating label {
        font-size: 30px;  
        color: lightgray;  
        margin: 0 2px;  
    }

    .rating input:checked ~ label {
        color: gold;  
    }

    .rating label:hover,
    .rating label:hover ~ label {
        color: gold;  
    }
</style>
