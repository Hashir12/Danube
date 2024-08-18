document.getElementById('contactNumber').addEventListener('input', function(event) {
    const input = event.target;
    const inputValue = input.value;
    const validInput = /^\+971(\s?[\-]?)?\d{2,3}(\s?[\-]?)?\d{7}$/.test(inputValue);

    if (!validInput) {
        input.setCustomValidity("Please enter a valid UAE phone number."); // Set custom error message
    } else {
        input.setCustomValidity(""); // Clear error message
    }
});

let academicQualificationIndex = 0; // counting in the name tag of academic qualifications
function addAcademicQualification() {
    academicQualificationIndex++;

    let newAcademicQualificationDiv = document.createElement('div');
    newAcademicQualificationDiv.classList.add('form-row');
    newAcademicQualificationDiv.classList.add('mt-2');

    newAcademicQualificationDiv.innerHTML = `
        <div class="col">
            <input type="text" name="academic_qualification[${academicQualificationIndex}][degree]" class="form-control qualificationName" placeholder="Degree/Diploma">
        </div>
        <div class="col">
            <input type="text" name="academic_qualification[${academicQualificationIndex}][institute_name]" class="form-control instituteName" placeholder="Institute Name">
        </div>
        <div class="col">
            <input type="text" name="academic_qualification[${academicQualificationIndex}][specialization]" class="form-control specialization" placeholder="Specialization">
        </div>
        <div class="col">
            <input type="number" name="academic_qualification[${academicQualificationIndex}][passing_year]" class="form-control yearOfPassing" placeholder="Year of Passing">
        </div>
        <div class="col">
            <input type="text" name="academic_qualification[${academicQualificationIndex}][percentage]" class="form-control percentageGrade" placeholder="Percentage/Grade">
        </div>
        <div class="col">
            <button class="btn btn-danger removeBtn" onclick="removeAcademicQualification(this)">Remove</button>
        </div>
    `;

    // Append the new academic qualification fields to the parent div
    document.getElementById('academicQualifications').appendChild(newAcademicQualificationDiv);
}
let workExperienceIndex = 0; // counting in the name tag of academic qualifications
function addWorkExperience() {
    academicQualificationIndex++;

    let workExperiences = document.createElement('div');
    workExperiences.classList.add('form-row');
    workExperiences.classList.add('mt-2');

    workExperiences.innerHTML = `
            <div class="col">
                <input type="text" name="work_experience[${academicQualificationIndex}][company]" class="form-control company" placeholder="Company">
            </div>
            <div class="col">
                <input type="text" name="work_experience[${academicQualificationIndex}][position]" class="form-control position" placeholder="Position">
            </div>
            <div class="col">
                <input type="text" name="work_experience[${academicQualificationIndex}][duration]" class="form-control duration" placeholder="Duration">
            </div>
            <div class="col">
                <input type="number" name="work_experience[${academicQualificationIndex}][salary_drawn]" class="form-control salaryDrawn" placeholder="Salary Drawn">
            </div>
            <div class="col">
                <input type="text" name="work_experience[${academicQualificationIndex}][reason_of_leaving]" class="form-control reasonOfLeaving" placeholder="Reason of Leaving">
            </div>
            <div class="col">
                <button class="btn btn-danger removeBtn" onclick="removeWorkExperience(this)">Remove</button>
            </div>
        `;

    document.getElementById("workExperiences").appendChild(workExperiences);
}

function removeAcademicQualification(btn) {
    const academicQualifications = document.getElementById("academicQualifications");
    const parentRow = btn.parentNode.parentNode;
    if (academicQualifications.childElementCount > 1) {
        academicQualifications.removeChild(parentRow);
    }
}

function removeWorkExperience(btn) {
    const workExperiences = document.getElementById("workExperiences");
    const parentRow = btn.parentNode.parentNode;
    if (workExperiences.childElementCount > 1) {
        workExperiences.removeChild(parentRow);
    }
}

const hierarchy = document.getElementById("hierarchy");
const hierarchyPad = new SignaturePad(hierarchy);

hierarchyPad.addEventListener("endStroke", (e) => {
    let img = hierarchyPad.toDataURL();
    let el = document.getElementById("company_hierarchy")
    el.value = img
});

const candidate_signature = document.getElementById("signature");
const signaturePad = new SignaturePad(candidate_signature);
signaturePad.addEventListener("endStroke", (e) => {
    let img = signaturePad.toDataURL();
    let el = document.getElementById("candidate_signature")
    el.value = img
});

document.getElementById("pre_interview_form").addEventListener("submit", function(event) {
    event.preventDefault();
    if (document.getElementById("declaration").checked) {
        this.submit();
    } else {
        alert("Please check the declaration checkbox.");
    }
});
