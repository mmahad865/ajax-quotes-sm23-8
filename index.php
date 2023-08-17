<html>
  <head>
    <title>PHP Test Page</title>
  </head>
  <body>
    <h1>PHP Test Page</h1>
    <?php
    echo '<p>This is PHP!</p>';
    ?>
  
  </body>
</html><html>
  <head>
    <title>AJAX Quotes</title>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Tulpen+One&display=swap');
      @import url('https://fonts.googleapis.com/css2?family=Qwitcher+Grypen:wght@700&display=swap');

      /* CSS to hide the quote container initially and apply fade-in animation */
        #quoteContainer {
            display: none;
            text-shadow: 4px 4px 4px #aaa;
        }

        body{
          background-color:#F5F5DC;
        }

    
        /* CSS for the fade-in animation */
        .fade-in {
            animation: fadeIn 1s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

    </style>
  </head>
  <body>
    <h1>AJAX Quotes</h1>
    <p>A random quote is generated every 5 seconds</p>
    <div id="quoteContainer">Quote goes here</div>
    <p> We created a page that retrieves random quotes from a PHP server side page using AJAX.<br>A quote          on page load, and then at intervals every few seconds.</p>



    
    <script>
      var counter=0;
      function getRandomQuote(){
        var fonts=["Qwitcher Grypen","Tulpen One","Shadows Into Light"];
        
        var xhr = new XMLHttpRequest();
        
        xhr.open('GET','random_quotes.php',true);
        
        xhr.onload=function(){
          //code on return of data goes here
          if(xhr.status >= 200 && xhr.status < 300){//good data returned,show it!
           // document.querySelector("#quoteContainer").innerText=xhr.responseText;
            
            var quoteContainer=document.querySelector("#quoteContainer");
            quoteContainer.innerText=xhr.responseText;
            quoteContainer.style.display='block';
            quoteContainer.style.fontFamily=fonts[counter];
            counter++;
            
            if(counter >= fonts.length){
              counter=0;
              
            }
            
            quoteContainer.classList.add("fade-in");

            setTimeout(function(){
               quoteContainer.classList.remove("fade-in");
              
            },1000);
    
          }else{//something went wrong,give feedback
           document.querySelector("#quoteContainer").innerText="Failed to fetch quote: " +  xhr.status ;
          }
        };
        
        xhr.onerror=function(){
          //code on error of data goes here
          alert("Oh oh!");
        };
        
        //sends data to server
        xhr.send();
      }

      function displayRandomQuote(){
        //initial page load
        getRandomQuote();
        //run again at intervals
        setInterval(getRandomQuote,5000);
      }
      //run on page load
      displayRandomQuote();
    </script>
   
  </body>
</html>
