@extends('layouts.structure')

@section('title', 'Contactos')



@section('content')
    
    <!--================Contact Area =================-->
    <section class="contact_area p_150">
        <div class="container">
            <div id="mapBox" class="mapBox" data-lat="40.701083" data-lon="-74.1522848" data-zoom="13" data-info="PO Box CT16122 Collins Street West, Victoria 8007, Australia."
                data-mlat="40.701083" data-mlon="-74.1522848">
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="contact_info">
                        <div class="info_item">
                            <i class="lnr lnr-home"></i>
                            <h6>Luanda, Angola</h6>
                            <p>Kilamba</p>
                        </div>
                        <div class="info_item">
                            <i class="lnr lnr-phone-handset"></i>
                            <h6>
                                <a href="#">(+244) 9XX XXX XXX</a>
                            </h6>
                            <p>Segunda-sexta 07H : 30min as 19H : 00</p>
                        </div>
                        <div class="info_item">
                            <i class="lnr lnr-envelope"></i>
                            <h6>
                                <a href="#">atendimento@preciosagarrido.com</a>
                            </h6>
                            <p>Envia-nos sua mensagem a qualquer momento</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <form class="row contact_form" id="contactForm" novalidate="novalidate">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                @guest
                                    <input type="text" name="name" placeholder="Nome" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nome '" class="form-control" />
                                @else
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" />
                                @endguest
                            </div>
                            <div class="form-group">
                                @guest
                                    <input type="email" name="email" placeholder="Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address '" class="form-control" />
                                @endguest
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="Assunto" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <textarea class="form-control" name="message" id="message" rows="1" placeholder="Sua mensagem para nós"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn submit_btn">Enviar Mensagem</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--================Contact Area =================-->

@stop