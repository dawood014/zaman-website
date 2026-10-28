<div class="faq">
    @forelse(($faqs ?? collect()) as $x)
        <details><summary>{{ $x->value('question', $x->title) }}</summary><p>{{ $x->value('answer') }}</p></details>
    @empty
        <details><summary>Do you provide both construction and property services?</summary><p>Yes. The company supports construction, renovation, project enquiries, ready houses and plot sales from one place.</p></details>
        <details><summary>Can customers buy property on installments?</summary><p>Selected houses and plots, including options in Zaman Villas, can be presented with cash and installment plans subject to current availability and terms.</p></details>
        <details><summary>Can I request a site visit or consultation?</summary><p>Yes. Use the contact form, property visit form or WhatsApp button to send your request directly to the company.</p></details>
    @endforelse
</div>
