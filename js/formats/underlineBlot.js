const Inline = Quill.import('blots/inline');

class UnderlineBlot extends Inline {
    static blotName = 'underline';
    static tagName = 'u';
}

Quill.register(UnderlineBlot);