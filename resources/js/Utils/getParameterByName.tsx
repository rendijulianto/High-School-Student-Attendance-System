export default function getParameterByName(name: string) {
    const uri = window.location.search;
    const match = RegExp("[?&]" + name + "=([^&]*)").exec(uri);
    return match && decodeURIComponent(match[1].replace(/\+/g, " "));
}
