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

function setAddress()
{
    if (document.getElementById("address").checked)
    {
        document.getElementById("homePhone").disabled = true;
        document.getElementById("unit").disabled = true;
        document.getElementById("house").disabled = true;
        document.getElementById("street").disabled = true;
        document.getElementById("suburb").disabled = true;
        document.getElementById("postcode").disabled = true;
        document.getElementById("region").disabled = true;
        document.getElementById("country").disabled = true;
        return;
    }
    else
    {
        document.getElementById("homePhone").disabled = false;
        document.getElementById("unit").disabled = false;
        document.getElementById("house").disabled = false;
        document.getElementById("street").disabled = false;
        document.getElementById("suburb").disabled = false;
        document.getElementById("postcode").disabled = false;
        document.getElementById("region").disabled = false;
        document.getElementById("country").disabled = false;
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
    var row = table.rows.length;
    var input = table.insertRow(row);
    
    var construct = "<th>Username ";
    construct += counter.value;
    construct += "</th><td><input type=\"text\" name=\"staff";
    construct += counter.value;
    construct += "\" required></td>";
    
    input.innerHTML = construct;
}

function decStaff()
{
    var counter = document.getElementById("count");
    var count = counter.value;
    
    var table = document.getElementById("table");
    var row = table.rows.length - 1;
    
    if (count > 1)
    {
        counter.value--;
        
        table.deleteRow(row);
    }
}