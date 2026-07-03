export function maskDate(value) {
    value = value.replace(/\D/g, '');
    value = value.slice(0, 10);

    value = value.replace(/(\d{2})(\d)/, '$1/$2');
    value = value.replace(/(\d{2})(\d)/, '$1/$2');

    return value;
}

export function maskCpf(value) {
    value = value.replace(/\D/g, '');
    value = value.slice(0, 11);

    value = value.replace(/(\d{3})(\d)/, '$1.$2');
    value = value.replace(/(\d{3})(\d)/, '$1.$2');
    value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

    return value;
}

export function maskPhone(value) {
    value = value.replace(/\D/g, '');
    value = value.slice(0, 11);

    value = value.replace(/(\d{2})(\d)/, '($1) $2');
    value = value.replace(/(\d{5})(\d)/, '$1-$2');

    return value;
}

export function maskMoney(value) {
    value = value.replace(/\D/g, '')

    if (!value) {
        return '';
    }

    value = Number(value) / 100;

    return value.toLocaleString('pt-BR', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    })
}