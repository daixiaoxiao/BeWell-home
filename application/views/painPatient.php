<!DOCTYPE html>
<body>

    <!-- container -->
    <div class="container">
        <div class="topMessage">
            Pain diary
        </div>
        <div id="painTitle" class="col-sm-5 lists">
            <div class="smalltitle">Enter Today's Data</div>
        </div>
        <div class="col-sm-1"></div>
        <div id="painTitle" class="col-sm-6 lists">
            <div class="smalltitle">Check Previous Data</div>
        </div>
        <div class="col-xs-12 col-sm-5 lists">
            <!-- class used to be smalltitle -->
            <div class="smallitem">Pain Scale</div>
            <div class="infoitem">Please indicate your pain levels on the slider</div>

            <?php echo form_open('PatientController/updatePain'); ?>
            <form role="form">
                <div class="row">
                    <div id="aboveEx1" class="col-xs-9 col-xs-offset-1 painslider">
                        <input id="ex1" name="pain" data-slider-id='ex1Slider' data-slider-min="0" data-slider-max="10" data-slider-step="1" data-slider-value="5" data-slider-ticks="[0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]" data-slider-ticks-labels='["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10 = max"]'/>
                        <script type="text/javascript">
                            $('#ex1').slider({
                                formatter: function (value) {
                                    return value;
                                }
                            });</script>
                    </div>
                </div>
                <div class="smallitem">Comments</div>
                <div class="row">
                    <div id="commentBox" class="col-xs-8 col-xs-offset-2 painslider">
                        <div class="form-group">
                            <label for="comment"> </label>
                            <textarea class="form-control" placeholder="Enter your comments here" rows="5" id="comment" name="comment"></textarea>
                        </div>
                    </div>
                    <div class="col-xs-8 col-xs-offset-2">
                        <button id="submitPain" type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
            <p></p>
        </div>
        <div class="col-sm-1"></div>
        <div class="col-sm-6 historyandcom hidden-xs lists">
            <div class="smallitem">History of Pain diary</div>
            <div class="row">
                <div id="historyBox" class="col-xs-8 col-xs-offset-2 painslider">
                    <div class="hero-unit">
                            <input  type="text" placeholder="{today}"  id="example1" onchange="changeTimeGraph()">
                    </div>
                    <script type="text/javascript">
                        $(document).ready(function () {

                            $('#example1').datepicker({
                                format: "dd/mm/yyyy",
                                autoclose: true,
                                endDate: "0d"
                            });
                        });

                        function changeTimeGraph() {
                            //alert("you changed the date!");
                            //drawPain('graphPainDiary', dataPain);
                            //var myDate = "08/12/2015";
                            var myDate = document.getElementById("example1").value;
                            myDate = myDate.split("/");
                            var newDate = myDate[1] + "/" + myDate[0] + "/" + myDate[2];
                            var someDate = new Date(newDate).getTime();
                            var $theDate = Math.floor(someDate / 1000) + 60 * 60 * 24 + 60 * 59 + 59;
                            //var theDate = someDate.getUnixTime();
                            //alert("the date: " + $theDate);
                            $.get("../../index.php/PatientController/getPainDataTime/" + $theDate, null, changeGraph);
                            $.get("../../index.php/PatientController/getHistoryPain/" + $theDate, null, changeComments);
                        }

                        function changeGraph(data) {
                            data = JSON.parse(data);
                            if (data !== null)
                            {
                                $("#graphContainer").show();
                                var dataPainNew = new google.visualization.DataTable();
                                dataPainNew.addColumn('date', 'Time');
                                dataPainNew.addColumn('number', 'Pain');
                                $.each(data, function (i, obj) {
                                    //dataPainNew.addRows([[new Date(obj.date*1000), Number(obj.painLevel)]]);
                                    var numberDate = obj.timestamp * 1000;
                                    dataPainNew.addRows([[new Date(numberDate), Number(obj.painLevel)]]);
                                });
                                drawPain('graphPainDiary', dataPainNew);
                                document.getElementById("errorDate").innerHTML = "";
                                
                                //document.getElementById("graphContainer").show();//style.visibility = "visible";
                            }
                            else
                            {
                                document.getElementById("errorDate").innerHTML = "No data for that date!";
                                $("#graphContainer").hide();
                                //document.getElementById("graphContainer").hide();//style.visibility = "hidden";
                            }
                        }
                        function changeComments(data) {
                            data = JSON.parse(data);
                            if (data !== null)
                            {
                                var stringComment = "";
                                $.each(data, function (i, obj) {
                                    stringComment = stringComment + obj.date + " pain: " + obj.painLevel + "\ncomment: " + obj.remark + "\n\n";
                                });
                                document.getElementById("commentArea").value = stringComment;
                            }
                            else
                            {
                                document.getElementById("commentArea").value = "No data for that date!";
                            }
                        }
                    </script>
                        <script type="text/javascript">
        //TODO
        //UPDATE DATA MODEL STATEMENTS FOR EASIER INSERTING ID
        //UPDATE CURRENT DATE

        var dataPain = google.visualization.arrayToDataTable([
            ['Time', 'Pain'],
<?php
if(isset($pain_data))
{
foreach ($pain_data as $data) {
    echo '[' . $data->date . ',' . $data->painLevel . '],';
}
}
?>
        ]);
        google.setOnLoadCallback(function () {
            drawPain('graphPainDiary', dataPain)
        });


    </script>
                    <p id="errorDate"> </p> 
                    <div class="responsive-container" id="graphContainer">
                        <div id="graphPainDiary" class="item active"></div>
                    </div>
                </div>
            </div>
            <div class="smallitem">History of comments</div>
            <div class="row">
                <div id="commentBox" class="col-xs-8 col-xs-offset-2 painslider">
                        <div>
                            <label for="comment"> </label>
                            <textarea class="form-control" rows="5" id="commentArea" name="comment" readonly>{history}{date} pain: {painLevel} &#10comment: {remark} &#10&#10{/history}</textarea>
                        </div>
                </div>
            </div>
            
            <p></p>
        </div>
    </div>
</body>
</html>