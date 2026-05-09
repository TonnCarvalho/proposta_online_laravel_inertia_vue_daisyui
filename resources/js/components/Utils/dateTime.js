export function formatDate(date) {
    return new Date(date).toLocaleDateString('pt-BR')
}

export function formatTime(date) {
    return new Date(date).toLocaleTimeString('pt-BR', {
        hour: '2-digit',
        minute: '2-digit'
    })
}