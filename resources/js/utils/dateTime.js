export function formatDate(date) {
    if (!date) {
        return '';
    }

    const dateOnly = String(date).slice(0, 10);
    const [year, month, day] = dateOnly.split('-')

    return `${day}/${month}/${year}`;
}

export function formatTime(date) {
    return new Date(date).toLocaleTimeString('pt-BR', {
        hour: '2-digit',
        minute: '2-digit'
    })
}