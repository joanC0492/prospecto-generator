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
      const titleDocument = document
        .querySelector(".prospecto__title")
        .textContent.trim();
      const owner = document
        .querySelector(".prospecto__owner")
        .textContent.trim();
      const fileName = `${titleDocument} - ${owner}.pdf`;
      console.log(fileName);
      pdf.save(fileName);
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

  const initChangeInputHiddenFormEdit = () => {
    const changeInputs = () => {
      const inputsId = ["#texto_presentacion"];
      for (let i = 0; i < inputsId.length; i++) {
        const editorContent = document
          .querySelector(`.editor-quill:has(+${inputsId[i]}) .ql-editor`)
          .innerHTML.trim();
        document.querySelector(`${inputsId[i]}`).value = editorContent;
      }
    };

    document.addEventListener("keypress", changeInputs);
    document.addEventListener("keydown", changeInputs);
    document.addEventListener("keyup", changeInputs);
  };

  // Llamar a la función para inicializar el generador de PDF
  initPDFGenerator();
  initChangeInputHiddenFormEdit();
  // Aquí puedes agregar más lógica que se ejecutará al cargar el DOM
  // Por ejemplo:
  // initOtraFuncionalidad();
});
