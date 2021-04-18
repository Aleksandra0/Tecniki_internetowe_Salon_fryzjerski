function validation()
{
    document.getElementById("result").innerHTML = "";

    let imie = document.getElementById('firstname').value;
    let nazwisko = document.getElementById('surname').value;
    let email = document.getElementById('email').value;
    let phone = document.getElementById('phone').value;
    let date = document.getElementById('date').value;


    let validation = 0;
    //Walidacja dla Imię
    if(imie.length < 2)
    {
        validation = 1;
        document.getElementById("result").innerHTML += "<p class='warning'> Wprowadzono niepoprawne imię </p>"
        document.getElementById("firstname").className = "invalid";
    }
    else
    {
        document.getElementById("firstname").removeAttribute("class");
    }

    //Walidacja dla Nazwisko
    if(nazwisko.length < 2)
    {
        validation = 1;
        document.getElementById("result").innerHTML += "<p class='warning'> Wprowadzono niepoprawne nazwisko </p>"
        document.getElementById("surname").className = "invalid";
    }
    else
    {
        document.getElementById("surname").removeAttribute("class");
    }

    //Walidacja dla Email
    const reg = /^[a-zA-Z0-9](.*)@[a-zA-Z0-9](.*)\.[a-zA-Z0-9]/
    if(reg.test(email)==false)
    {
        validation = 1;
        document.getElementById("result").innerHTML += "<p class='warning'> Wprowadzono niepoprawny adres email </p>"
        document.getElementById("email").className = "invalid";
    }
    else
    {
        document.getElementById("email").removeAttribute("class");
    }

    //Walidacja dla Telefon kontaktowy
    const reg2 = /^[0-9]{9}$/
    phone = phone.trim();
    phone = phone.replaceAll(" ","");
    if(reg2.test(phone)==false)
    {
        validation = 1;
        document.getElementById("result").innerHTML += "<p class='warning'> Wprowadzono niepoprawny numer telefonu </p>"
        document.getElementById("phone").className = "invalid";
    }
    else
    {
        document.getElementById("phone").removeAttribute("class");
    }

    //Walidacja dla Daty
    let today = new Date();
    date = Date.parse(date);
    if(date <= today)
    {
        validation = 1;
        document.getElementById("result").innerHTML += "<p class='warning'> Wprowadzono niepoprawną datę wizyty </p>"
        document.getElementById("date").className = "invalid";
    }
    else
    {
        document.getElementById("date").removeAttribute("class");
    }

    if(validation == 0)
    {
        document.getElementById('val').setAttribute("value", 1);
    }
}
function clean()
{
    document.getElementById('form_area').innerHTML = "";
}