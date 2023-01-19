function generatePDF(){
    
    const element = document.getElementById("content");

    html2pdf()
    .from(element)
    .save();
}