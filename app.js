document.addEventListener("DOMContentLoaded", () => {
  const header = document.querySelector(".main-header");

  window.addEventListener("scroll", () => {
    if (window.scrollY > 0) {
      header.classList.add("scrolled");
    } else {
      header.classList.remove("scrolled");
    }
  });
});

const burgerMenu = document.querySelector(".burger-menu");
const menuOverlay = document.querySelector(".menu-overlay");

burgerMenu.addEventListener("click", () => {
  menuOverlay.classList.toggle("active");
  burgerMenu.classList.toggle("open");
});

document
  .getElementById("contactForm")
  .addEventListener("submit", async function (e) {
    e.preventDefault();
    const btn = document.getElementById("con-btn");

    const formData = new FormData(e.target);

    try {
      btn.innerHTML = "იგზავნება...";
      const response = await fetch("https://tbilrides.ge/send_email.php", {
        method: "POST",
        body: formData,
      });
      if (response.ok) {
        btn.innerHTML = "მეილი გაგზავნილია..";
        btn.style.backgroundColor = "green";
        btn.style.color = "white";
        e.target.reset();
      } else {
        btn.innerHTML = "შეცდომა გაგზავნის დროს ";
        btn.style.backgroundColor = "red";
        btn.style.color = "white";
      }
      setTimeout(() => {
        btn.innerHTML = "დაგვიკავშირდით";
        btn.style.backgroundColor = "black";
      }, 5000);
    } catch (error) {
      console.error("Error:", error);
    }
  });
