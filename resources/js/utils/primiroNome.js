export default function primeiroNome(value) {
    if(!value) return "";
    
    value = value.trim();

    const primeiroNome = value.toLowerCase().split(" ")[0];

    return primeiroNome.at(0).toUpperCase() + primeiroNome.slice(1)
}