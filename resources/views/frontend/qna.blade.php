@extends('frontend.layouts.master')
@section('meta_title')
@endsection
@section('title')
Q & A
@endsection
@push('styles')
@endpush

@section('content')
<section class="inr-bnr">
    <div class="inr-bnr-img">
        <img src="{{ asset('frontend_assets/images/blog-bg.jpg') }}" alt="" />
        <div class="inr-bnr-text">
            <h1>Q & A</h1>
        </div>
    </div>
</section>
<section class="q-acc">
    <div class="container">
        <div class="head-1 h-b text-center" data-aos="fade-up" data-aos-duration="1000">
            <h2>Frequently <span>Asked Questions</span></h2>
            <p>We have curated a list of general FAQs covering all your queries.</p>
        </div>
        <div class="q-acc" data-aos="fade-up" data-aos-duration="1000">
            <div class="accordion" id="accordionExample">
                <div class="row justify-content-between">
                    <div class="col-xl-6">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    1. What is an HSA?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show"
                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    A Health Savings Account (HSA) is a purpose saving account that enables
                                    individuals to pay for qualifying health care expenses with pre-tax funds
                                    while participating in a High Deductible Health Plan. You can use this HSA
                                    to pay for current health expenses, save for future qualified medical and
                                    retiree health expenses, or invest in IRAs.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                    aria-expanded="false" aria-controls="collapseTwo">
                                    2. How does an HSA work?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse"
                                aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p><b>Funding - </b>you may contribute to your HSA on a pre-determined
                                        schedule throughout the year.</p>
                                    <p><b>Accessing funds - </b>you can pay for your payment cards, payout of
                                        pocket, request reimbursement online, or use the mobile app. Always keep
                                        your receipts as you may need them for an IRS audit.</p>
                                    <p><b>Requesting reimbursement - </b> it is quick and easy to submit
                                        requests for reimbursement and upload receipts online or using the
                                        mobile app.</p>
                                    <p><b>Reimbursement processing - </b>promptly process your requests and
                                        reimburse by checking or direct depositing. You receive money sooner in
                                        direct deposits.</p>
                                    <p><b>Account management - </b>you can check your balance, review claims
                                        activity, and access valuable tools just by logging in to your mobile
                                        account.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                    aria-expanded="false" aria-controls="collapseThree">
                                    3. What are the benefits of establishing an HSA?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse"
                                aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Tax savings - HSA provides tax deductions when you contribute to your
                                    account and a tax-free income when your employer contributes to your
                                    account. It also provides tax-free earnings through investments and tax-free
                                    withdrawals for qualified medical expenses. Affordability - HSA carries
                                    higher deductible but lower monthly premiums. The savings from lower
                                    premiums can be put in the funding of the HSA. Flexibility - allows you to
                                    pay your current medical expenses or save money for future needs. The money
                                    saved can be invested, and your account can grow through tax-free investment
                                    earnings. Ownership and portability- accounts are entirely portable, which
                                    means that you can keep your HSA even if you change jobs, change your
                                    medical coverage or become unemployed.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                    aria-expanded="false" aria-controls="collapseFour">
                                    4. Can I withdraw money from my HSA account for other purposes?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse"
                                aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Yes, you can withdraw money from your HSA account at any time and for any
                                    purpose. However, suppose the money is used for an ineligible expense. In
                                    that case, the expenditure will be taxed, and the individuals who are not
                                    disabled or over age 65 are subject to a 20% tax penalty.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                    aria-expanded="false" aria-controls="collapseFive">
                                    5. Can I change the amount I contribute to my HSA during the plan year?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse"
                                aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Yes, you can change the amount you contribute to your HSA at any time during
                                    the year. If you change the amount contributed via payroll on a pre-tax
                                    basis, check with your employer. You can also make non-payroll contributions
                                    changes using the contribution center in your online account. This allows
                                    you to make or change contributions regularly or on a one-time basis.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseSix"
                                    aria-expanded="false" aria-controls="collapseSix">
                                    6. Can my employer contribute to my HSA?
                                </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse"
                                aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Yes, the contributions to HSAs can be made by you, your employer, or
                                    both. All the contributions are determined by whether you have
                                    contributed the maximum allowed or not. If your employer is contributing
                                    some of the money to your account, you can make up the difference. If
                                    your employer contributes to your HSA account, the contribution is not
                                    taxable to you, the employee.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSeven">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseSeven"
                                    aria-expanded="false" aria-controls="collapseSeven">
                                    7. What investment options can I get with my HSA?
                                </button>
                            </h2>
                            <div id="collapseSeven" class="accordion-collapse collapse"
                                aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    If you decide to buy into an HSA, then you have to make three basic
                                    choices:
                                    - Interest-bearing account
                                    - Money market account
                                    - Mutual funds account
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingEight">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseEight"
                                    aria-expanded="false" aria-controls="collapseEight">
                                    8. Can I use an HSA for my health insurance?
                                </button>
                            </h2>
                            <div id="collapseEight" class="accordion-collapse collapse"
                                aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Yes, the HSA is designed to cover the expenses not paid by your health
                                    plan, including deductibles, coinsurance, and copayments, as well as
                                    many expenses your health plan may not cover, such as acupuncture, eye
                                    surgery, and some over the counter medicines.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingNine">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseNine"
                                    aria-expanded="false" aria-controls="collapseNine">
                                    9. What is a High Deductible Health Plan?
                                </button>
                            </h2>
                            <div id="collapseNine" class="accordion-collapse collapse"
                                aria-labelledby="headingNine" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    A High Deductible Health Plan (HDHP) combines a Health Savings Account or a
                                    Health Reimbursement Arrangement with traditional medical coverage. It
                                    provides insurance coverage and a tax-advantaged way to help save future
                                    medical expenses. All these three give you greater flexibility and
                                    discretion over how you use your health care dollars because the funds can
                                    be used to cover qualified medical expenses that are not covered by your
                                    health plan.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTen">
                                <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseTen"
                                    aria-expanded="false" aria-controls="collapseTen">
                                    10. Does my HSA still in function after my death?
                                </button>
                            </h2>
                            <div id="collapseTen" class="accordion-collapse collapse"
                                aria-labelledby="headingTen" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    You can designate a beneficiary or beneficiaries to receive your remaining
                                    HSA funds after your death. For example, your spouse can be the designated
                                    beneficiary of your HSA, and it will be treated as your spouse's HSA after
                                    your death. If your spouse is not the designated beneficiary of your HSA or
                                    the beneficiary is your estate. The account stops being an HSA, and the fair
                                    market value becomes taxable to the beneficiary in which year you die. If
                                    you don't designate a beneficiary, then the funds will be distributed
                                    according to the rules of the Custodial Agreement.
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
</section>
@endsection

@push('scripts')
@endpush
