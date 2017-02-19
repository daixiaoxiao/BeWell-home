
<body>
    <div class="container">
        <div class="row">
            <div class="topMessage">
                Messages
            </div>
        </div>
        {messages}
        <div class="row lists">
            <div class="col-sm-12">
                <div class="accordion" id="accordion">
                    <div class="panel">
                        <div class="accordion-heading">
                            <div class="accordion-title smalltext row padderpart">
                                <a class="accordion-toggle smalltitle col-sm-4" data-toggle="collapse" data-parent="#accordion" href="#{id}">
                                    <input type="hidden" name="idQuestion" value="{idQuestion}">
                                    {title} 
                                    <span class="glyphicon glyphicon-menu-down"></span>
                                </a>
                                <button class="btn btn-remover floater" id="delete"  data-MessageId={id} onclick="myDelete({id})">
                                    <a class="glyphicon glyphicon-remove"></a>
                                </button>                                        
                            </div>
                        </div>
                        <div  class="accordion-body collapse">
                            <div class="accordion-inner smallitem">
                                {message}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {/messages}


        <script>
            function myDelete(clicked_id) {
                    $.get("../../index.php/PatientController/deleteMessage/" + clicked_id, null, null);
                    $(this).blur();
                    location.href = location.href;
}

        </script>




    </div>
</body>
</html>