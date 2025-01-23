<?php include('layouts/header.php'); ?>

      <!-- Contact -->
      <section id="contact" class="container my-5 py-5">
        <div class="container text-center my-5">
            <h2 style="font-family: Poppins;">Contact Us</h2>
            <hr class="mx-auto" style="border: 4px solid coral; width: 3%;">
            <p class="w-50 mx-auto">
               Phone Number: <span>123 456 789</span>
            </p>

            <p class="w-50 mx-auto">
                Email address: <span>info@email.com</span>
             </p>

             <p class="w-50 mx-auto">
                We work 24/7 to answer your questions
             </p>

             <div class="contact-form">
                <form name="submit-to-google-sheet">
                    <input type="text" name="Name" placeholder="Your Name" required>
                    <input type="email" name="email" placeholder="Your Email" required>
                    <textarea name="Message" rows="6" placeholder="Your Message"></textarea>
                    <button type="submit" class="buy-btn">Submit</button>
                </form>
                <span id="msg"></span>

            </div>
        </div>
      </section>

      <script>
      const scriptURL = 'https://script.google.com/macros/s/AKfycbzMbJG9vr8sd1Fz1k7J9OUZof4PRpavvc-wMmtR3c8I6GRUgliG8iPfvYtfsKONXANC/exec'
      const form = document.forms['submit-to-google-sheet']

      const msg =document.getElementById("msg");
      
      form.addEventListener('submit', e => {
         e.preventDefault()
         fetch(scriptURL, { method: 'POST', body: new FormData(form)})
         .then(response => {
            msg.innerHTML = "Message sent successfully";
            setTimeout(function(){
               msg.innerHTML = "";
            }, 1000);
            form.reset();
         })
         .catch(error => console.error('Error!', error.message))
  })
</script>
      <?php include('layouts/footer.php'); ?>