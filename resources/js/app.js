import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();
import html2canvas from "html2canvas";
import jsPDF from "jspdf";

document.addEventListener("DOMContentLoaded", () => {
  const initPDFGenerator = () => {
    const generatePDF = async () => {
      const pdf = new jsPDF("p", "mm", "a4");
      const sections = ["#portada > .page-a4", "[id^='page-'] > .page-a4"];
      let yOffset = 0;

      const sections_ = document.querySelectorAll(sections.join(","));
      for (let i = 0; i < sections_.length; i++) {
        const section = sections_[i];
        const canvas = await html2canvas(section, { scale: 1 });
        const imgData = canvas.toDataURL("image/png");
        const imgWidth = 210; // Ancho A4 en mm
        const imgHeight = (canvas.height * imgWidth) / canvas.width;

        if (i > 0) pdf.addPage();
        pdf.addImage(imgData, "PNG", 0, yOffset, imgWidth, imgHeight);
        console.log(imgHeight);
      }

      pdf.save("documento.pdf");
    };

    const button = document.createElement("button");
    button.textContent = "Generar PDF";
    button.classList.add("btn", "btn-primary");
    button.style.position = "fixed";
    button.style.bottom = "20px";
    button.style.right = "20px";
    document.body.appendChild(button);
    button.addEventListener("click", generatePDF);

    const a = document.createElement("a");
    a.textContent = "Editar PDF";
    a.classList.add("btn", "btn-primary");
    a.style.position = "fixed";
    a.style.bottom = "70px";
    a.style.right = "20px";
    document.body.appendChild(a);
    a.setAttribute("href", "/prospecto/edit");
  };

  // Llamar a la función para inicializar el generador de PDF
  initPDFGenerator();

  // Aquí puedes agregar más lógica que se ejecutará al cargar el DOM
  // Por ejemplo:
  // initOtraFuncionalidad();
  // initMasCosas();
});
