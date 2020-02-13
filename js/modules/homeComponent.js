export default {
    template: `<h1> {{ message }} </h1>`,

    created: function() {
        console.log('our home component rendered');
    },

    data: function() {
        return {
            message: "This is my home page!",
        }
    }
}