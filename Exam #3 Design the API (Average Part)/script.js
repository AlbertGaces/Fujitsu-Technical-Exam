var tableBody = document.querySelector('.table-body');
let output = "";

// ============== DISPLAY EMPLOYEE DATA ==============

var renderPosts = (posts) => {
    posts.forEach(post => {
        output += `
            <tr>
                <td>${post.id}</td>
                <td>${post.fullname}</td>
                <td>${post.position}</td>
                <td>${post.section}</td>
                <td>${post.status}</td>
            </tr>
        `;
    });
    tableBody.innerHTML = output;
}
var url = 'https://5fdb12ee91f19e00173339f5.mockapi.io/employee';


fetch(url).then(res => res.json()).then(data => renderPosts(data))



// ============== ADD EMPLOYEE DATA ==============

var addEmployeeForm = document.querySelector('#addEmployeesForm');
var employeeNameValue = document.getElementById('inputEmployeeName');
var employeePositionValue = document.getElementById('inputEmployeePosition');
var employeeSectionValue = document.getElementById('inputEmployeeSection');
var employeeStatusValue = document.getElementById('inputEmployeeStatus');

addEmployeeForm.addEventListener('submit', (e) => {
    e.preventDefault();
    fetch("https://5fdb12ee91f19e00173339f5.mockapi.io/employee", {
        method: 'POST',
        headers: {
            'Content-Type':'application/json'
        },
        body: JSON.stringify ({
            fullname: employeeNameValue.value,
            position: employeePositionValue.value,
            section: employeeSectionValue.value,
            status: employeeStatusValue.value
        })
    }).then(res => res.json()).then(data => {
        var dataArray = [];
        dataArray.push(data);
        renderPosts(dataArray);
    })
})


