<?php include('layouts/header.php')?>

<div class="wrapper" >
    <h1>Frequently Asked Questions</h1>

    <div class="faq">
        <button class="accordion">
            Do you ship to my country?
            <i class="fa-solid fa-chevron-down"></i>
        </button>
        <div class="pannel" >
            <p>
            Yes. We proudly ship worldwide! 🌎 ✅
            <br>
            We’ve shipped amazing apparel free to over 200+ countries and we love adding more to the list
            </p>
        </div>
    </div>

    <div class="faq">
        <button class="accordion">
            How long does shipping take? When will I receive my order?
            <i class="fa-solid fa-chevron-down"></i>
        </button>
        <div class="pannel" >
            <p>
            It all depends on where you are in the world
            <br><br>
            For USA and Canada shipping takes 7-21 days
            <br><br>
            For Europe, Oceania, and South-East Asia shipping takes 9-21 days
            <br><br>
            For all other countries shipping takes 14-35 days
            <br><br>
            It usually takes us 1-5 days to process orders. We aim to ship all items on-time, but in rare cases it can take longer. 
            Any orders not received within 8 weeks qualify for a full-refund or reship 
            </p>
        </div>
    </div>

    <div class="faq">
        <button class="accordion">
            My order has been dispatched, can I track it?
            <i class="fa-solid fa-chevron-down"></i>
        </button>
        <div class="pannel" >
            <p>
            Once your order has been shipped, you’ll receive a tracking number via email.
             Note, it can take up to 7 days for shipping activity to update.
            </p>
        </div>
    </div>

    <div class="faq">
        <button class="accordion">
            Do you offer a guarantee? Can I return my items?
            <i class="fa-solid fa-chevron-down"></i>
        </button>
        <div class="pannel" >
            <p>
            Of course. We offer an extended 30 day guarantee! ☑️
            <br><br>
            If you aren’t 100% satisfied with your items, or received faulty goods, simply email our customer support team at  info@email.com.
            <br><br> 
            Please include the email address associated with the order and describe the issue.
            <br><br>
            We always aim to respond in 3 days or less!
            </p>
        </div>
    </div>

    <div class="faq">
        <button class="accordion">
            Can I change or cancel my order?
            <i class="fa-solid fa-chevron-down"></i>
        </button>
        <div class="pannel" >
            <p>
            Sure! You can cancel, or change your order within 12 hours of confirmation. 
            <br><br>
            Please contact us with your name and order number at:  info@email.com.
            <br><br>
            After 12 hours, your order will have been processed and we won’t be able to make any changes or cancel it.
            </p>
        </div>
    </div>

    <div class="faq">
        <button class="accordion">
            What payment method do you take??
            <i class="fa-solid fa-chevron-down"></i>
        </button>
        <div class="pannel" >
            <p>
                We accept ALL major credit cards and, PayPal
            </p>
        </div>
    </div>
</div>

<script>
    var acc =document.getElementsByClassName("accordion");
    var i;
    for (let i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function(){
            this.classList.toggle("active");
            this.parentElement.classList.toggle("active");
            
            var pannel = this.nextElementSibling;
            if(pannel.style.display === "block"){
                pannel.style.display = "none";
            }
            else{
                pannel.style.display = "block";
            }
        });
    }
</script>
<?php include('layouts/footer.php') ?>