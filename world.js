window.onload = function(){

    const countrylookupBtn = document.querySelector('#lookup');
    const cityLookupbtn = document.querySelector("#lookup_cities")
    var httpReq;

    countrylookupBtn.addEventListener('click', function(elements){

        elements.preventDefault();
        

        //making an AJAX request for countries from the countries database
        httpReq = new XMLHttpRequest();
        const lookup = document.querySelector('#country').value;
        let url = "http://localhost/info2180-lab5/world.php?country=";//"superheroes.php?query= http://localhost/info2180-lab4/superheroes.php";
        httpReq.onreadystatechange = countryLookup;
        httpReq.open('GET', url+lookup, true);
        httpReq.send();
        console.log(lookup);
    });

    cityLookupbtn.addEventListener('click', function(elements){
        elements.preventDefault();

        //making an AJAX request for cities from the cities database
        httpReq = new XMLHttpRequest();
        const lookup = document.querySelector('#country').value;
        let url = 'http://localhost/info2180-lab5/world.php?country=';
        httpReq.onreadystatechange = countryLookup;
        httpReq.open('GET', url+lookup+'&context=cities', true);
        httpReq.send();
        console.log(lookup);
    });

    

    //handling the response to an AJAX request
    function countryLookup(){

        const result = document.querySelector('#result');
        

        if (httpReq.readyState === XMLHttpRequest.DONE){
            if (httpReq.status === 200){
                let response = httpReq.responseText;
                console.log(response);
                result.innerHTML = response;
                //alert(response);
            } else {
                alert('There was a problem with the request');
            }
        }
    }

};