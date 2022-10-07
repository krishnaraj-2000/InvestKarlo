
function PayNow(payment_token)
{
    console.log("pay" + payment_token);
   Layer.checkout({
       token: payment_token,
       accesskey: "1f45e200-35b1-11ed-b90f-b16cebea646f",
       theme: {
           logo : "https://open-logo.png",
           color: "#3d9080",
           error_color : "#ff2b2b"
         }
   },
   
   function(response) {
       
       console.log(response);
       if (response.status == "captured") {
          // response.payment_token_id
          // response.payment_id
          window.location.href = "success_redirect_url";

       } else if (response.status == "created") {


       } else if (response.status == "pending") {


       } else if (response.status == "failed") {
         window.location.href = "payment";

       } else if (response.status == "cancelled") {
         window.location.href = "payment";
       }
   },
   function(err) {
       //integration errors
   }
   );
}
