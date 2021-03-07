<div class="col-lg-8">
    @if($errors->any())
        <div class="alert alert-danger mt-2">
            <ul class="list-unstyled">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form
        class="form-area contact-form text-right"
{{--        id="myForm"--}}
        action="{{ route('mail.contacts') }}"
        method="post"
    >
        @csrf
        <div class="row">
            <div class="col-lg-6 form-group">
                <input
                    name="name"
                    placeholder="Enter your name"
                    onfocus="this.placeholder = ''"
                    onblur="this.placeholder = 'Enter your name'"
                    class="common-input mb-20 form-control"
                    type="text"
                />

                <input
                    name="email"
                    placeholder="Enter email address"
{{--                    pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$"--}}
                    onfocus="this.placeholder = ''"
                    onblur="this.placeholder = 'Введите email'"
                    class="common-input mb-20 form-control"
{{--                    required--}}
                    type="email"
                />

                <input
                    name="subject"
                    placeholder="Тема"
                    onfocus="this.placeholder = ''"
                    onblur="this.placeholder = 'Введите тему письма'"
                    class="common-input mb-20 form-control"
                    type="text"
                />
            </div>
            <div class="col-lg-6 form-group">
                  <textarea
                      class="common-textarea form-control"
                      name="message"
                      placeholder="Enter Messege"
                      onfocus="this.placeholder = ''"
                      onblur="this.placeholder = 'Введите сообщение'"
                  ></textarea>
            </div>
            <div class="col-lg-12">
                <div class="alert-msg" style="text-align: left;"></div>
{{--                <input type="submit" value="Отправить">--}}
                <button
                    type="submit"
                    class="primary-btn text-uppercase"
                    style="float: right;"
                >
                    Send Message
                </button>
            </div>
        </div>
    </form>
</div>
