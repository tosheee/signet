    <footer id="footer-content">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h4 class="title"></h4>
                    <p>
                        {!! isset($siteViewInformation->description_com) ? $siteViewInformation->description_com : 'Description company'!!}
                    </p>

                    <ul class="social-icon">
                        <a href="#" class="social"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        <a href="#" class="social"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        <a href="#" class="social"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        <a href="#" class="social"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                        <a href="#" class="social"><i class="fa fa-google" aria-hidden="true"></i></a>
                        <a href="#" class="social"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
                    </ul>
                </div>

                <div class="col-sm-3">
                    <h4 class="title">Контакти</h4>
                    <span class="acount-icon">
                        <a href="#"><i class="fa fa-phone" aria-hidden="true"></i>{{ isset($siteViewInformation->phone_com) ? $siteViewInformation->phone_com : '0888 888 888'}}</a>
                        <a href="#"><i class="fa fa-envelope-open" aria-hidden="true"></i>{{ isset($siteViewInformation->email_com) ? $siteViewInformation->email_com : 'example@com.com' }}</a>
                        <a href="#"><i class="fa fa-globe" aria-hidden="true"></i>{{ isset($siteViewInformation->address_com) ? $siteViewInformation->address_com : 'City' }}</a>
                        <a href="#"><i class="fa fa-clock" aria-hidden="true"></i>{{ isset($siteViewInformation->work_time_com) ? $siteViewInformation->work_time_com : 'Work time' }}</a>
                        <a href="{{ isset($siteViewInformation->map_com) ? $siteViewInformation->map_com : '#' }}"><i class="fa fa-location" aria-hidden="true"></i>Локация</a>
                    </span>
                </div>

                <div class="col-sm-3">
                    <h4 class="title">Категории</h4>
                    <div class="category">
                        @foreach($categoriesButtonsName as $categoryButton)
                            <a href="/store/search?category={{ $categoryButton->id }}" title="{{ $categoryButton->name }}">
                                {{ $categoryButton->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="col-sm-3">
                    <h4 class="title">Доставка</h4>
                    <p>
                        След като потвърдите поръчката си, доставката ще бъде извършена в повечето случаи в следващият работен ден, вкл.събота.
                        И не по-късно от два работни дни.
                        Доставката се плаща допълнително и е за сметка на получателя.
                        Стойността на поръчката се заплаща на куриера.

                    </p>

                    <ul class="payment">
                        <li><a href="#"><i class="fa fa-cc-amex" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-credit-card" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-paypal" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-cc-visa" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
            <hr>

            <div class="row text-center"> © 2018 by Todor Chakarov.</div>
        </div>
    </footer>