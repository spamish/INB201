function init()
{
    calendar.set("date");
}

function setWard()
{
    document.write( document.getElementsByName( "position" ).value );
    document.getElementByName( "ward" ).disabled = true;
    
    switch (document.getElementsByName( "position" ).value)
    {
        case "technician":
            document.getElementByName( "ward" ).disabled = true;
        break;
        
        case "administrator":
            document.getElementsByName( "ward" ).disabled = true;
        break;
        
        default:
            document.getElementsByName( "ward" ).disabled = false;
        break;
    }
}
