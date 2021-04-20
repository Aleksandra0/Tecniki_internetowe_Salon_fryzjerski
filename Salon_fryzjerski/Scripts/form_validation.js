function validation()
{
    document.getElementById("result").innerHTML = "";

    let imie = document.getElementById('firstname').value;
    let nazwisko = document.getElementById('surname').value;
    let email = document.getElementById('email').value;
    let phone = document.getElementById('phone').value;
    let date = document.getElementById('date').value;


    let validation = 0;
    //validation for firstname
    if(imie.length < 2)
    {
        validation = 1;
        document.getElementById("result").innerHTML += "<p class='warning'> Wprowadzono niepoprawne imię </p>"
        imie.className = "invalid";
    }
    else
    {
        imie.removeAttribute("class");
    }

    //Validation for surname
    if(nazwisko.length < 2)
    {
        validation = 1;
        document.getElementById("result").innerHTML += "<p class='warning'> Wprowadzono niepoprawne nazwisko </p>"
        nazwisko.className = "invalid";
    }
    else
    {
        nazwisko.removeAttribute("class");
    }

    //Validation for email
    const reg = /^[a-zA-Z0-9](.*)@[a-zA-Z0-9](.*)\.[a-zA-Z0-9]/
    if(reg.test(email)==false)
    {
        validation = 1;
        document.getElementById("result").innerHTML += "<p class='warning'> Wprowadzono niepoprawny adres email </p>"
        email.className = "invalid";
    }
    else
    {
        email.removeAttribute("class");
    }

    //Validation for phone
    const reg2 = /^[0-9]{9}$/
    phone = phone.trim();
    phone = phone.replaceAll(" ","");
    if(reg2.test(phone)==false)
    {
        validation = 1;
        document.getElementById("result").innerHTML += "<p class='warning'> Wprowadzono niepoprawny numer telefonu </p>"
        phone.className = "invalid";
    }
    else
    {
        phone.removeAttribute("class");
    }

    //Validation for date
    let today = new Date();
    date = Date.parse(date);
    if(date <= today)
    {
        validation = 1;
        document.getElementById("result").innerHTML += "<p class='warning'> Wprowadzono niepoprawną datę wizyty </p>"
        date.className = "invalid";
    }
    else
    {
        date.removeAttribute("class");
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
