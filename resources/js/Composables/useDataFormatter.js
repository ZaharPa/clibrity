export const useDataFormatter = () => {
    const formatDate = (date) => {
        const options = { year: 'numeric', month: 'long', day: 'numeric'}
        return new Date(date).toLocaleDateString('en-GB', options)
    };

    return { formatDate };
}
