document.addEventListener('DOMContentLoaded', function() {
    const debitCardRadio = document.getElementById('debit-card');
    const paypalRadio = document.getElementById('paypal');
    const debitCardDetails = document.querySelector('.debit-card-details');
    const paypalDetails = document.querySelector('.paypal-details');
    if (debitCardRadio) {
      function togglePaymentDetails() {
        if (debitCardRadio.checked) {
            debitCardDetails.style.display = 'block';
            paypalDetails.style.display = 'none';
        } else if (paypalRadio.checked) {
            debitCardDetails.style.display = 'none';
            paypalDetails.style.display = 'block';
        }
      }
      debitCardRadio.addEventListener('change', togglePaymentDetails);
      paypalRadio.addEventListener('change', togglePaymentDetails);
    }
});

function setPrint() {
  const closePrint = () => {
    document.body.removeChild(this);
  };
  this.contentWindow.onbeforeunload = closePrint;
  this.contentWindow.onafterprint = closePrint;
  this.contentWindow.print();
}
  
const printExternal = document.getElementById("print_external");
if (printExternal) {
  printExternal.addEventListener("click", () => {
    const hideFrame = document.createElement("iframe");
    hideFrame.onload = setPrint;
    hideFrame.style.display = "none"; // hide iframe
    hideFrame.src = "checkout.php";
    document.body.appendChild(hideFrame);
  });
}
