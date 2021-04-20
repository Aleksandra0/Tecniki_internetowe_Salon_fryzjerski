function validation()
{
    document.getElementById("result").innerHTML = "";

    let imie = document.getElementById('firstname');
    let nazwisko = document.getElementById('surname');
    let email = document.getElementById('email');
    let phone = document.getElementById('phone');
    let date = document.getElementById('date');


    let validation = 0;
    //Validation for name
    if(imie.value.length < 2)
    {
        validation = 1;
        document.getElementById("result").innerHTML += "<p class='warning'> Wprowadzono niepoprawne imię </p>"
        imie.className = "invalid";
    }
    else
    {
        imie.removeAttribute("class");
    }

    ///Validation for surname
    if(nazwisko.value.length < 2)
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
    if(reg.test(email.value)==false)
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
    phone2 = phone.value.trim();
    phone2 = phone2.replaceAll(" ","");
    if(reg2.test(phone2)==false)
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
    date2 = Date.parse(date.value);
    if(date2 <= today)
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
