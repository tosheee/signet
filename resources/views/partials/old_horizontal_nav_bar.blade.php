@include('partials.parts_horizontal_nav.top_h_nav')
@include('partials.parts_horizontal_nav.middle_h_nav')
@include('partials.parts_horizontal_nav.bottom_h_nav')
@include('partials.parts_horizontal_nav.scroll_h_nav')
@include('partials.parts_horizontal_nav.contact_form')

<script>

    var modalContactForm = document.getElementById('modal-contact-form-wrapper');
    var btnViewContact = document.getElementById("view-contact-form");
    var spanContactForm = document.getElementsByClassName("close")[0];



    btnViewContact.onclick = function() {
        console.log('click button');
        modalContactForm.style.display = "block";
    }

    spanContactForm.onclick = function() {
        modalContactForm.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modalContactForm) {
            modalContactForm.style.display = "none";
        }
    }
</script>