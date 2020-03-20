export default {
    template: `
    <div>
    <h1>This is the contact page</h1>

    <form id="my-form"> 
    <form action="php/sign.php" method="post"> 
    <label for="name">Name:</label>
    <input id="name" type="text" name="name">

    <label for="gender">Gender:</label>
    <select id="gender" name="gender">
        <option value="male">Male</option>
        <option value="male">Female</option>
        <option value="prefer not to say">Prefer Not to Say</option>          
    </select>

    <label for="age">Age:</label>
    <select id="age" name="age">
        <option value="under 18">Under 18</option>
        <option value="18-30">18-30</option>
        <option value="31-40">31-40</option>
        <option value="41-50">41-50</option>
        <option value="over50">Over 50</option>
        <option value="prefer not to say">Prefer Not to Say</option>               
    </select>

    <label for="email">Email:</label>
    <input id="email" type="email" name="email">

    <label for="message">Message</label>
    <textarea id="message" name="message" placeholder="Please type your message"></textarea>

    <button name="submit">Register</button>
    </form>

    `,


    methods: {
        // submit(){
            
        //     // console.log('hit the API PAN is asking for,which should be the root Vue instance');

        //     document.querySelector('form').reset();

        //     // reset the username and password data in our app
        //     // this.user = "";
        //     // this.password = "";
        // }
    },

    created: function() {
        console.log('our contact component rendered');
    },
}