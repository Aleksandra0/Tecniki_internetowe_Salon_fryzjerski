function change_photos(direction)
{
    let sources = ['CSS/Images/gallery1.jpg','CSS/Images/gallery2.jpg','CSS/Images/gallery3.jpg','CSS/Images/gallery4.jpg','CSS/Images/gallery5.jpg'];
    let current_sources = [document.getElementById('photo1').getAttribute('src'),document.getElementById('photo2').getAttribute('src'),document.getElementById('photo3').getAttribute('src')];
    for(let i = 0; i <= 4; i++)
    {
        if(sources[i] == current_sources[0])
        {
            console.log("lol", i)
            beggining=i;
        }
    }
    console.log(beggining)
    let new_sources = [];
    if(direction == 1)
    {
        if(beggining == 0)
        {
            new_sources = [sources[4],sources[0],sources[1]];
        }
        else if(beggining == 4)
        {
            new_sources = [sources[3],sources[4],sources[0]];
        }
        else
        {
            new_sources = [sources[beggining-1],sources[beggining],sources[beggining+1]];
        }
    }
    else
    {
        if(beggining == 2)
        {
            new_sources = [sources[3],sources[4],sources[0]];
        }
        else if(beggining == 3)
        {
            new_sources = [sources[4],sources[0],sources[1]];
        }
        else if(beggining == 4)
        {
            new_sources = [sources[0],sources[1],sources[2]];
        }
        else
        {
            new_sources = [sources[beggining+1],sources[beggining+2],sources[beggining+3]];
        }
        
    }

    document.getElementById('photo1').setAttribute('src', new_sources[0]);
    document.getElementById('photo2').setAttribute('src', new_sources[1]);
    document.getElementById('photo3').setAttribute('src', new_sources[2]);
}