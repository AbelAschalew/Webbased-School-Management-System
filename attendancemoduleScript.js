var attDate;
var attClassId="";
var arrSelectedStuId = [];
var arrSelectedStuName = [];

var addAttendanceBtn = document.getElementById("addAttendance");
addAttendanceBtn.onclick = addAttendance;
//addAttendanceBtn.onclick = fetchAttend;

function addAttendance() {
    attDate = document.getElementById("attendanceDate").value;
    attClassId = document.getElementById("classId").value;
    var students = document.getElementById("studentStatus");
    var selectedStudents = Array.from(students.selectedOptions);
    for (let i=0; i<selectedStudents.length; i++) {
        arrSelectedStuId[i] = selectedStudents[i].value;
    }
    for (let i=0; i<selectedStudents.length; i++) {
        arrSelectedStuName[i] = selectedStudents[i].innerHTML;
    }
    //console.log(selectedStudents[0].innerHTML);
    //console.log(selectedStudents[0].value);
    //console.log(selectedStudents[1].value);
    //console.log(attDate);
    //console.log(attClassId);
    //console.log("hello");
    fetchAttend();
}

function fetchAttend() {
    var trow = document.createElement("tr");
    var tdDate = document.createElement("td");
    var tdClassId = document.createElement("td");
    var tdPresentStuds = document.createElement("td");

    tdDate.innerHTML = attDate;
    tdClassId.innerHTML = attClassId;
    for (let i=0; i<arrSelectedStuName.length; i++) {
        tdPresentStuds.innerHTML += arrSelectedStuName[i]+",<br>";
    }

    var table = document.getElementById("attendanceRecordsTable");

    trow.appendChild(tdDate);
    trow.appendChild(tdClassId);
    trow.appendChild(tdPresentStuds);

    table.appendChild(trow);
}