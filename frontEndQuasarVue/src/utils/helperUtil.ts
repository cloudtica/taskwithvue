export default {

    methods: {
        validateEmail(email: string): boolean {
            const reg = /^([A-Za-z0-9_\-.+])+@([A-Za-z0-9_\-.])+\.([A-Za-z]{2,})$/;
            if (!reg.test(email)) return false;
            return true;
        },
        removeClass(element: HTMLElement, className: string) {
            element.classList.remove(className);
        },
        addClass(element: HTMLElement, className: string) {
            element.classList.add(className);
        },
        stringReplaceWithString(target: string, search: string, replacement: string): string {
            const finalString: string = target.split(search).join(replacement);
            return finalString;
        },
        hasWhiteSpace(str: string) {
            return /\s/g.test(str);
        },
        scrollInToViewCenter(element : HTMLElement) {
            if(element) {
                element.scrollIntoView({ behavior: 'auto', block: 'center', inline: 'center', });
            }
        },
        scrollInToViewStart(element : HTMLElement) {
            if(element) {
                element.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }
    }
};
