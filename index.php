<html>
<head>
<title>Painting Web Service Demo</title>
<style>
  
  body {
    font-family:georgia;
    background-color:midnightblue;
    }

  
  .film {
      border: 1px solid #E77DC2;
      border-radius: 5px;
      background-color:#F1F1F1;
      padding: 5px;
      margin-bottom: 5px;
      position: relative;
     min-height: 150px;
  }


  .pic{
    position:absolute;
    right:10px;
    top:10px;
  }

  .pic img{
	max-width:85px;
  }

  h1{
    background-color: #E2DCC8;
    padding: 5px;
  }

  h3{
    background-color: #E2DCC8;
    padding: 5px;
  }

</style>
<script src="https://code.jquery.com/jquery-latest.js"></script>

<script type="text/javascript">

function bondTemplate(film){
  return `
    <div class = "film">
      <b>Title</b>: ${film.Title}<br>
      <b>Artist</b>: ${film.Artist}<br>
      <b>Cost</b>: ${film.Cost}<br>
      <b>Year</b>: ${film.Year}<br>
      <b>Note</b>: ${film.Note}<br>
      <div class= "pic"><img src = "painting_webservice/${film.Image}"></div>
    </div>
  `;
}
  
$(document).ready(function() { 
 $('.category').click(function(e){
   e.preventDefault(); //stop default action of the link
   cat = $(this).attr("href");  //get category from URL

   //clear old films 
   $("#films").html("");
  
   var request = $.ajax({
     url: "api.php?cat=" + cat,
     method: "GET",
     dataType: "json"
   });
   request.done(function( data ) {
     console.log(data);

     $("#filmtitle").html(data.title);

     $.each(data.films,function(i,item){
       let myData = bondTemplate(item);
       $("<div></div>").html(myData).appendTo('#films');
     });
     
    /*
    let myData = JSON.stringify(data,null,4);
     myData = "<pre>" + myData + "</pre>";
     $("#output").html(myData); 
     */
   });
   request.fail(function(xhr, status, error ) {
alert('Error - ' + xhr.status + ': ' + xhr.statusText);
   });
  });
}); 

</script>
</head>
	<body>
	<h1>Painting Web Service</h1>
		<a href="year" class="category"><strong>Painting By Year</a><br /></strong>
		<a href="box" class="category"><strong>Painting by Price</a></strong>
		<h3 id="filmtitle">Title Will Go Here</h3>
		<div id="films">
      <!--
      <div class = "film">
      <b>Film</b>: 1<br>
      <b>Title</b>: Dr. No<br>
      <b>Director</b>: Terence Young<br>
      <b>Producers</b>: Harry Saltzman and Albert R. Broccoli<br>
      <b>Writers</b>: Richard Maibaum, Johanna Harwood and Berkely Mather<br>
      <b>Composer</b>: Monty Norman<br>
      <b>Bond</b>: Sean Connery<br>
      <b>Budget</b>: $1,000,000.00<br>
      <b>BoxOffice</b>: $59,567,035.00<br>
      <div class= "pic"><img src = "thumbnails/dr-no.jpg"></div>
      </div> 
      -->
		</div>
		<div id="output">Results go here</div>
	</body>
</html>
