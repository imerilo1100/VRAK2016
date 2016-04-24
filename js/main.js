    window.onload = function() {
        if (document.getElementsByName("start_date")[0] && document.getElementsByName("start_date")[0]) {

            var today = new Date().toISOString().split('T')[0];
            document.getElementsByName("start_date")[0].setAttribute('min', today);
            document.getElementsByName("finish_date")[0].setAttribute('min', today);
            document.getElementsByName("start_date")[0].addEventListener('change', changeDateSelect);
        }

        if(document.getElementsByName("title")[0]){
            document.getElementsByName("title")[0].addEventListener('change', votingck);
        }
    };

    function changeDateSelect() {
        var second = document.getElementsByName("start_date")[0].value;
        document.getElementsByName("finish_date")[0].setAttribute('min', second);
    }

    function votingck(){
        var title = document.getElementsByName("title")[0].value;

        $.post("/function/checkvalues.php", {
            title : title
        }).done(function(value){
            if(value)
            {
                document.getElementById("titleck").innerHTML=title+" on saadaval!";
            }
            else
            {
                document.getElementById("titleck").innerHTML=title+" ei ole saadaval!";
            }
        });
    }

    $(document).ready(function() {
        var ch = false;
        function last_candidate(){
            ch=true;
            var ID = $(".candidateList:last").attr("id");
            $('div#last_cand_loader').html('Laadin...');
            $.post("function/load_more.php?last_cand="+ID,
                function (data) {
                    if(data != ""){
                        $(".candidateList:last").after(data);
                    }
                    $('div#last_cand_loader').empty();
                    ch=false;
                });
        }

        $(window).scroll(function(){
            if($(window).scrollTop() == $(document).height() - $(window).height()){
                if(ch == false) {
                    last_candidate();
                }
            }
        })

    });