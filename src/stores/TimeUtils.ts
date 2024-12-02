// src/lib/stores/timeUtils.ts
export function convertTo12HourFormat(time: string): string {
    const [hour, minute] = time.split(':');
    const hr = parseInt(hour);
    const period = hr >= 12 ? 'PM' : 'AM';
    const twelveHour = hr % 12 || 12; // Convert 0 to 12 for midnight
    return `${twelveHour}:${minute} ${period}`;
}

export function convertTo24HourFormat(time: string): string {
    const [hourMin, period] = time.split(' ');
    let [hour, minute] = hourMin.split(':');
    let hr = parseInt(hour);

    if (period === 'PM' && hr < 12) {
        hr += 12;
    } else if (period === 'AM' && hr === 12) {
        hr = 0;
    }

    return `${hr.toString().padStart(2, '0')}:${minute}`;
}
