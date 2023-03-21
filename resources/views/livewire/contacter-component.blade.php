<section class="mb-4">

    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-4 color p1">Contact us</h2>
    <!--Section description-->
    <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us
        directly. Our team will come back to you within
        a matter of hours to help you.</p>

    <div class="row container mx-auto">

        <!--Grid column-->
        <div class="col-md-11 mb-md-0 mb-5">
            <form id="contact-form" name="contact-form">
                @if ($validationMessage)
                    <div class="alert alert-info">{{ $validationMessage }}</div>
                @endif
                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <label for="name" class="mt-3">Your name</label>
                            <input wire:model="name" type="text" id="name" name="name" class="form-control">

                        </div>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <label for="email" class="mt-3">Your email</label>
                            <input wire:model='email' type="text" id="email" name="email" class="form-control">
                        </div>
                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <label for="YOURNumber" class="mt-3">Your Number</label>
                            <input wire:model='number' type="text" id="YOURNumber" name="subject"
                                class="form-control">
                        </div>
                    </div>
                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-12">

                        <div class="md-form">
                            <label for="message " class="mt-3">Your message</label>
                            <textarea wire:model='contenu' type="text" id="message" name="message" rows="2"
                                class="form-control md-textarea"></textarea>
                        </div>

                    </div>
                </div>
                <!--Grid row-->

            </form>

            <div class="text-center text-md-left ">
                <button class="btn color w-25 mt-5 " wire:click.prevent="post">
                    @if ($loading)
                        Loading ...
                    @else
                        Send
                    @endif
                </button>
            </div>
            <div class="status"></div>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-1 text-center mt-5">
            <ul class="list-unstyled mb-0">
                <li><i class="bi bi-geo-alt-fill fs-1  text-secondary"></i>
                    {{-- <p>San Francisco, CA 94126, USA</p> --}}
                </li>

                <li><i class="bi bi-telephone-fill fs-1 text-secondary"></i>
                    {{-- <p>+ 01 234 567 89</p> --}}
                </li>

                <li><i class="bi bi-envelope-fill fs-1 text-secondary"></i>
                    {{-- <p>contact@mdbootstrap.com</p> --}}
                </li>
            </ul>
        </div>
        <!--Grid column-->

    </div>

</section>
