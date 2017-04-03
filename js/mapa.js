
function cetvrtiGraf(){

$("#opstine").load("img/opstine.svg");

    var boje = ["#ffffcc", "#c2e699", "#78c679", "#31a354", "#006837"];

    //["#feebe2", "#fbb4b9", "#f768a1", "#c51b8a", "#7a0177"];//d3.scale.category20c().domain([1,30]);
    //d3.scale.linear().domain([1,30]).range(['red', 'blue']);//, 'blue'
    var index = 0;


    setTimeout(
        function() {
            $("#opstine g>g").parent().each(function() {
                if (["PRIZREN", "PECKI", "KOSOVSKO_POMORAVSKI", "KOSOVSKI", "KOSOVSKA_MITROVICA"].indexOf(this.id) != -1) return; // kosovo
                //console.log(this.id);
                $("#" + this.id).click(function() {
       		      prikaziModal(this.id, {"a":"b"});
       		      /* 	$("#sadrzaj-modala").html( this.id );
       		       	$('#myModal').modal();*/
       		             
                })
                $("#" + this.id + " g polygon," + "#" + this.id + " g path").each(function() {
                    $(this).attr("fill", boje[Math.floor(Math.random() * 5)]);
                })
                

            }); // okruzi

            //$("svg").find("#PRIZREN g ").click(function(){alert(this.id)})
            //$("svg").find("#PRIZREN g polygon").attr("fill","yellow")

        }, 1000)


}

function prikaziModal(opstina,parametri) {

        var temop = "<tr><td>Poslanik</td><td>Plata</td></tr>";
            for (var i = parametri.length - 1; i >= 0; i--) {
                temop+="<tr><td>"+parametri[i].ime +"</td><td>"+parametri[i].plata+"</td></tr>"; 
            };

        var unos = parametri.a 
        +"<br> <table class='table'>"
        +"<thead>"
        + "<tr>"
            + "<th>Red</th>"
            + "<th>Poslanik</th>"
            + "<th>Plata</th>"
            
        + "</tr>"
   + " </thead>"
    + "<tbody>"
     + "   <tr>"
     + "       <td>1</td>"
     + "       <td>John</td>"
     + "       <td>johncarter@mail.com</td>"
     + "   </tr>"
     + "   <tr>"
     + "       <td>2</td>"
     + "       <td>Peter</td>"     
     + "       <td>peterparker@mail.com</td>"
     + "   </tr>"
     + "   <tr>"
     + "       <td>3</td>"
     + "       <td>John</td>"     
     + "       <td>johnrambo@mail.com</td>"
     + "   </tr>"
   + " </tbody>"
+ "</table> "
        + opstina
        ;

                     $("#sadrzaj-modala").html( unos );
                    $('#myModal').modal();
    }

    