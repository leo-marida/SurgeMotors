document.addEventListener("DOMContentLoaded", function () {
    
    document.getElementById('signOutBtn')?.addEventListener('click', function () {
        localStorage.removeItem('username');
        localStorage.clear();
    
        window.location.href = 'index.html';
    });

    document.getElementById('signOutBtn2')?.addEventListener('click', function () {
        localStorage.removeItem('username');
        localStorage.clear();
    
        window.location.href = 'index.html';
    });
    
    const teamMembers = [
        { name: "Leonard Marida", position: "CEO", image: "../images/Leonard.jpg" },
        { name: "Abdel-Rahim el-Hani", position: "Sales Manager", image: "../images/AbdelRahim.jpg" },
        { name: "Hadi Majed", position: "Corporate Relations Manager", image: "../images/Hadi.jpg" },
        { name: "Omar al-Ghadban", position: "Lead Technician", image: "../images/Omar.jpg" } // Added 4th member
    ];

    const teamSection = document.getElementById("team-members");
    teamMembers.forEach(member => {
        const memberDiv = document.createElement("div");
        memberDiv.classList.add("team-member");

        memberDiv.innerHTML = `
            <img src="${member.image}" alt="${member.name}">
            <h3>${member.name}</h3>
            <p>${member.position}</p>
        `;

        teamSection.appendChild(memberDiv);
    });
});
function toggleMenu() {
    document.querySelector('.mobile-menu').classList.toggle('active');
}