<?php include "head.php"; ?>

<header></header>

<body>
    <!--sidebar code-->
    <div class="sidebar">
        <ul>
            <li><a href="#home">Top</a></li>
            <li><a href="#assignments">Assignments</a></li>
            <li><a href="#profile">Profile</a></li>
            <li><a href="#contact">Contact</a></li>
            
        </ul>
        <button class="sidebarBtn">
            <span></span>
        </button>
    </div>

    <!--main hero image at top -->
    <div class="pimg1">        
        <div class="ptext">
            <div class="mainName">
                <h2><a name="home">Joseph Gale</a></h2>
            </div>
            <div class="location">
                <h3>Des Moines, IA</h3>
            </div>
            <div class="description">
                <p>Assignments</p>     
                <p>CS 313 | Winter 2020 | BYU-I</p>
            </div>
        </div>
        
    </div>

    <!--Section 1: Assignments-->
    <div class="section">
        <div class="tab">
            <h2><a name="assignments">Assignments</a></h2>
        </div>
    </div>

    <div class="s2">
        <div class="s2col">
            <p>Coming soon...</p>
        </div>
    </div>
    
    <div class="s2">
        <div class="s2col">
            <p>Date</p>
        </div>
        <div class="s2col">
           <p>Project Title</p>
        </div>
        <div class="s2col">
            <p>Project Link</p>
        </div>
    </div>

    <div class="pimg2">
        <div class="ptext">
        <div class="location">
            <h3>"If you can dream it, you can do it."</h3>
            <h3>~Walt Disney</h3>
        </div>
    </div>
    </div>

    <!--Section 2: Profile-->
    <div class="profile">
        <div class="section">
            <div class="tab">
                <h2><a name="profile">Profile</a></h2>
            </div>
        </div>

        <div class="s3">
            <div class="s3col">
                <p class="scriptFont">About me</p>
                <div class="aboutMe">
                    <p>I'm a former account manager pursuing a degree in Web Development at BYU-I. I am passionate about leveraging
                        technology to improve workflow efficiency, deliver an outstanding customer experience and repair sales-funnel leaks. 
                        When I'm not improving my skills in web development you might find me volunteering with refugees,
                        finding a new hiking trail or jamming to YouTube videos on my cello.
                    </p>
                </div>
                
            </div>
            <div class="s3col">
            <img src="img/profile.jpg">
            
            </div>
            <div class="s3col">
                <p class="scriptFont">Details</p>
                <div class="details">
                <p class="pDetails">Major: Applied Technology</p>
                <p class="pDetails">Completed courses:</p>
                <ul>
                    <li>CIT 260 (Object Oriented Programming with Java)</li>
                    <li>CIT 336 (Web Backend Development)</li>
                    <li>CIT 261 (Mobile Application Development)</li>
                </ul>
                <p class="pDetails">Current courses:</p>
                <ul>
                    <li>CIT 365 (.NET Development)</li>
                    <li>CIT 325 (Database Programming)</li>
                    <li>CS 313 (Web Engineering II)</li>
                </ul>
                </div>

            </div>
        </div>
    </div>

    <div class="pimg3">
        <div class="ptext">
        <div class="location">
            <h3>"Oh the places you'll go.</h3>
            <h3>~Dr. Suess</h3>
        </div>
    </div>
    </div>

    <!--Section 3: Contact-->
    <div class="section">
        <div class="tab">
            <h2><a name="contact">Contact</a></h2>
        </div>
    </div>

    <div class="s4">
        <div class="s4col">  
            <a href="http://linkedin.com/in/connectwithjoseph">         
            <img src="img/linkedin.png">
            <p>www.linkedin.com/in/connectwithjoseph</p>
            </a>
         </div>
        <div class="s4col">
            <a href = "mailto: gal16026@byui.edu">
            <img src="img/byui.svg">   
            <p>gal16026@byui.edu</p>
            </a>
        </div>
        
        <div class="s4col"> 
            <a href="https://GitHub.com/Gale-Joseph">  
            <img src="img/github.svg">          
            <p>GitHub.com/Gale-Joseph</p>
            </a>
        </div>
    </div>        
</body>
</html>

<?php include "footer.php"; ?>