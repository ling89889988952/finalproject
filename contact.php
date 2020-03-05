
    <div>
        <div>
            <h2>Want get more knowledge about Hiv?</h2>
        </div>
        <div>
            <h2>Subscription</h2>
            <form action="php/member.php" method="post"> 
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
                    <option value="under 14">Under 14</option>
                    <option value="14-19">14-19</option>
                    <option value="20-30">20-30</option>
                    <option value="31-40">31-40</option>
                    <option value="41-50">41-50</option>
                    <option value="over50">Over 50</option>
                    <option value="prefer not to say">Prefer Not to Say</option>               
                </select>

                <label for="email">Email:</label>
                <input id="email" type="email" name="email">

                <label for="message">Message</label>
                <textarea id="message" name="message" placeholder="Please type your message"></textarea>
        
                <button name="submit">Submit</button>
                </form>
        </div>
    </div>
    <script src="js/main.js"></script>