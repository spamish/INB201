function setWard()
{
    switch (document.getElementById("position").value)
    {
        case "doctor":
            document.getElementById("ward").disabled = false;
            document.getElementById("ward").value = "A";
            document.getElementById("ward").options[4].disabled = true;
            document.getElementById("ward").options[5].disabled = true;
            document.getElementById("ward").options[6].disabled = true;
            break;
        case "surgeon":
            document.getElementById("ward").disabled = true;
            document.getElementById("ward").value = "G";
            document.getElementById("ward").options[4].disabled = true;
            document.getElementById("ward").options[5].disabled = true;
            document.getElementById("ward").options[6].disabled = true;
            break;
        case "nurse":
            document.getElementById("ward").disabled = false;
            document.getElementById("ward").value = "A";
            break;
        case "receptionist":
            document.getElementById("ward").disabled = true;
            document.getElementById("ward").value = "A";
            break;
        case "technician":
            document.getElementById("ward").disabled = true;
            document.getElementById("ward").value = "E";
            break;
        case "administrator":
            document.getElementById("ward").disabled = true;
            document.getElementById("ward").value = "F";
            break;
    }
}

function setUsername()
{
    if (document.getElementById("checkbox").checked)
    {
        document.getElementById("username").disabled = true;
        return;
    }
    else
    {
        document.getElementById("username").disabled = false;
        return;
    }
}

function setID()
{
    if (document.getElementById("identified").checked)
    {
        document.getElementById("admission").action = "admission_extended.php";
        document.getElementById("firstName").required = true;
        document.getElementById("surname").required = true;
        document.getElementById("date").disabled = false;
        return;
    }
    else
    {
        document.getElementById("admission").action = "admission_summary.php";
        document.getElementById("firstName").required = false;
        document.getElementById("surname").required = false;
        document.getElementById("date").disabled = true;
        return;
    }
}

function selectInputs()
{
    if (document.getElementById("radRoom").checked)
    {
        document.getElementById("room").disabled = false;
        document.getElementById("ward").disabled = true;
        document.getElementById("doctor").disabled = true;
    }
    
    if (document.getElementById("radWard").checked)
    {
        document.getElementById("room").disabled = false;
        document.getElementById("ward").disabled = false;
        document.getElementById("doctor").disabled = false;
    }
    
    if (document.getElementById("radDoctor").checked)
    {
        document.getElementById("room").disabled = true;
        document.getElementById("ward").disabled = true;
        document.getElementById("doctor").disabled = false;
    }
}

function incStaff()
{
    var counter = document.getElementById("count");
    var count = counter.value;
    counter.value++;
    
    var table = document.getElementById("table");
    var row = table.rows.length - 1;
    var input = table.insertRow(row);
    
    var construct = "<td>Username ";
    construct += counter.value;
    construct += "</td><td><input type=\"text\" name=\"staff"
    construct += counter.value;
    construct += "\" required></td>";
    
    input.innerHTML = construct;
}

function decStaff()
{
    var counter = document.getElementById("count");
    var count = counter.value;
    if (count > 1)
    {
        counter.value--;
        
        var table = document.getElementById("table");
        var row = table.rows.length - 2;
        
        table.deleteRow(row);
    }
}