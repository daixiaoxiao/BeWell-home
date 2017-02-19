<body>
        <div class="container">

            <!-- message on top of the screen -->
            <div class="row">
                <div class="topMessage">
                    How to do your step count and oxygen measurements
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
                            <img class="img imgCarousel" src="../../assets/images/Oxygen_1.jpg">
                            <div class="caption carousel-caption">
                                <div class="smalltitle">Configure activity tracker sensor</div>
                                <div class="smalltext"></div>
                            </div>
                        </div>

                        <!-- second "slide" -->
                        <div class="item">
                            <img class="img imgCarousel" src="../../assets/images/Oxygen_2.jpg">
                            <div class="caption carousel-caption">
                                <div class="smalltitle">Wear tracker</div>
                                <div class="smalltext"></div>
                            </div>
                        </div>
                        <!-- third "slide" -->
                        <div class="item">
                            <img class="img imgCarousel" src="../../assets/images/Oxygen_3.jpg">
                            <div class="caption carousel-caption">
                                <div class="smalltitle">Activate oxygen meter</div> 
                                <div class="smalltext"></div>
                            </div>
                        </div>
                        
                        <!-- fourth "slide" -->
                        <div class="item">
                            <img class="img imgCarousel" src="../../assets/images/Oxygen_4.jpg">
                            <div class="caption carousel-caption">
                                <div class="smalltitle">Hold finger on meter for 10 seconds</div>
                                <div class="smalltext"></div>
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