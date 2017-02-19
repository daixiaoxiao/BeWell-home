    <body>
        <div class="container">

            <!-- message on top of the screen -->
            <div class="row">
                <div class="topMessage">
                    How to do your weight measurements
                </div>
            </div>

            <!-- carousel -->
            <div class="row">
                <div id="myCarousel" class="carousel slide" data-wrap="false" data-interval="false">
                    
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                        <li data-target="#myCarousel" data-slide-to="3"></li>
                    </ol>
                    
                    <!-- Wrapper for slides -->
                    <div id=carInner class="carousel-inner" role="listbox">
                        
                        <!-- first "slide" -->
                        <div class="item active">
                            <img class="img imgCarousel" src="../../assets/images/Blood_1.jpg">
                            <div class="caption carousel-caption">
                            <div class="smalltitle">Attach Meter</div>
                                <div class="smalltext">Wrap the cuff around your arm</div>
                            </div>
                        </div>
                        <!-- second "slide" -->
                        <div class="item">
                            <img class="img imgCarousel" src="../../assets/images/Blood_2.jpg">
                            <div class="caption carousel-caption">
                                <div class="smalltitle">Start Measurement</div>
                                <div class="smalltext">Put the gauge and pump in the shown place</div>
                            </div>
                        </div>
                        <!-- third "slide" -->
                        <div class="item">
                            <img class="img imgCarousel" src="../../assets/images/Blood_3.jpg">
                            <div class="caption carousel-caption">
                                <div class="smalltitle">Retry Measurement</div> 
                                <div class="smalltext">In case of error, redo the last step</div>
                            </div>
                        </div>
                        <!-- fourth "slide" -->
                        <div class="item">
                            <img class="img imgCarousel" src="../../assets/images/Blood_4.jpg">
                            <div class="caption carousel-caption">
                                <div class="smalltitle">Detach sensor</div>
                                <div class="smalltext">Read off the numbers from the indicator</div>
                            </div>
                        </div>
                    </div>
                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <div class="btn btn-primary backtombutton" onclick="location.href = 'dataPatient'">Back to measurements</div>
            </div>
        </div>
    </body>
</html>