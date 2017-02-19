<!DOCTYPE html>

<body>

    <!-- container -->
    <div class="container">

        <!-- top message -->
        <div class="topMessage">
            Survey
        </div>

        <!-- answer sheet -->
        <div class="surveyLayout lists col-sm-12">

            <!-- title of the answer sheet -->
            <div class="smalltitle">
                QUESTIONS:
            </div>

            <!-- questions -->
            {questions}
            <?php echo form_open('PatientController/updateSurvey'); ?>

            <input type="hidden" name="idQuestion" value="{idQuestion}">

            <div class="paragraph smallitem">
                {question}
            </div>

            <form class="form-inline" role="form">

                <div class="row">

                    <div class="col-sm-5 col-xs-8 answers">
                        <label class="radio-inline smalltext">
                            <input type="radio" name="optradio" value="{option1}">
                            {option1}
                        </label>
                        <label class="radio-inline smalltext">
                            <input type="radio" name="optradio" value="{option2}">
                            {option2}
                        </label>
                        <label class="radio-inline smalltext">
                            <input type="radio" name="optradio" value="{option3}">
                            {option3}
                        </label>
                    </div>

                    <div class="col-sm-7 col-xs-4">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>

                </div>
            </form>
            {/questions}
            <!-- /questions -->

            <!-- /answer sheet -->
        </div>

        <?php echo form_close(); ?>

        <!-- /container -->
    </div>

</body>

</html>