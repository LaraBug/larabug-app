class LaraBug {
    success = `<p>Thanks for your report, we'll jump right on it!</p>`;

    template = `<div id="larabug_feedback_modal" class="larabug-modal">
			<div class="larabug-modal-window">
				<form id="larabug_feedback_modal_form">
					<div class="larabug-modal-body">
						<h3>It looks like something went wrong!</h3>
						<p>Dont worry, we're onto it! However if you'd like to tell us what happened please let us know below.</p>
						
						<div class="larabug-control">
							<label for="larabug_name">Your name</label>
							<input type="text" id="larabug_name" name="name" placeholder="Jane Doe">
						</div>
		
						<div class="larabug-control">
							<label for="larabug_email">Your email</label>
							<input type="email" id="larabug_email" name="email" placeholder="Your email">
						</div>
						
						<div class="larabug-control">
							<label for="larabug_feedback">Your feedback</label>
							<textarea id="larabug_feedback" name="feedback" placeholder="I clicked the save button which made it explode 🧨"></textarea>
						</div>
					</div>
				
					<div class="larabug-modal-footer">
						<button type="submit" class="larabug-submit">Submit Report</button>
						<a class="larabug-modal-close">x</a>
						<div>
							Error Reporting by <a target="_blank" href="https://www.larabug.com">Lara<span style="color:#D22651">Bug</span></a><br />
							Reference ID: <span id="larabug-reference-id"></span>
						</div>
					</div>
				</form>
			</div>
		</div>`;

    styles = `<style>
		.larabug-modal-footer {
			display: flex;
			justify-content: space-between;
			align-items: center;
			background-color: #e2e8f0;
			padding: 1rem;
		}
		
		.larabug-modal-footer a {
			text-decoration: none;
			color: #636b6f;
		}
		
		.larabug-modal-footer div {
			text-align: right;
		}
		
		.larabug-modal {
		 	font-family: 'Nunito', sans-serif;
		 	font-weight: 200;
		 	color: #636b6f;
			position: fixed;
			top: 0;
			left: 0;
			bottom: 0;
			right: 0;
			display: none;
			overflow: auto;
			background-color: #000000;
			background-color: rgba(0, 0, 0, 0.7);
			z-index: 9999;
		}
		
		.larabug-modal-body {
			padding: 1rem;
		}
		
		.larabug-control input, textarea {
			display: block;
			width: 100%;
			padding: .375rem .75rem;
			font-size: 1rem;
			line-height: 1.5;
			color: #495057;
			background-color: #fff;
			background-clip: padding-box;
			border: 1px solid #ced4da;
			border-radius: .25rem;
			transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
			margin-bottom: 1rem;
			box-sizing : border-box;
		}
	
		.larabug-modal-window {
			position: relative;
			background-color: #FFFFFF;
			width: 50%;
			margin: 10% auto;
		}
		.larabug-modal-window h3 {
			margin-top: 0;
		}
		
		.larabug-modal-window {
			width: 50%;
		}
		
		.larabug-modal-close {
			position: absolute;
			top: 10px;
			right: 10px;
			color: rgba(0,0,0,0.3);
			height: 30px;
			width: 30px;
			font-size: 30px;
			line-height: 30px;
			text-align: center;
		}
		
		.larabug-modal-close:hover,
		.larabug-modal-close:focus {
			color: #000000;
			cursor: pointer;
		}
		
		.larabug-modal-open {
			display: block;
		}
		
		.larabug-submit {
		    color: #fff;
			background-color: #D22651;
			border-color: #D22651;
			cursor: pointer;
			display: inline-block;
			font-weight: 400;
			text-align: center;
			border: 1px solid transparent;
			padding: .375rem .75rem;
			font-size: 1rem;
			line-height: 1.5;
			border-radius: .25rem;
			transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
		}
		</style>`;

    modal = null;
    id = null;
    hasInitted = false;

    // Constructor
    constructor(id, name, email) {
        this.id = id;

        this.init(name, email);
    }

    // Initiator
    init(name, email) {
        if (this.hasInitted) {
            return;
        }

        // Add the modal to the body
        document.body.innerHTML += this.template + this.styles;

        // Set reference ID
		document.getElementById('larabug-reference-id').textContent = this.id

		// If name was passed, set that value
		if (name) {
			document.getElementById("larabug_name").value = name
		}

		// If email was passed, set that value
		if (email) {
			document.getElementById("larabug_email").value = email
		}

        this.modal = document.getElementById('larabug_feedback_modal');
        this.registerCloseHandler();
        this.registerSubmidHandler();
        this.hasInitted = true;
    }

    // Register handlers for the close button
    registerCloseHandler() {
        Array.from(document.getElementsByClassName("larabug-modal-close")).forEach((el) => {
            el.addEventListener('click', () => {
                this.modal.classList.remove('larabug-modal-open')
            });
        });
    }

    // Register a handler for form submission
    registerSubmidHandler() {
        document.getElementById('larabug_feedback_modal_form').addEventListener('submit', (e) => {
            e.preventDefault();
            this.submit();
        });
    }

    // Function to open the modal
    leaveFeedback() {
        this.modal.classList.add('larabug-modal-open');
    }

    // Send data to LaraBug
    submit() {
        let data = {
            name: document.getElementById("larabug_name").value,
            email: document.getElementById("larabug_email").value,
            feedback: document.getElementById("larabug_feedback").value,
            id: this.id
        };

        let xhr = new XMLHttpRequest();
        xhr.open("POST", 'http://larabug-website.test/api/feedback', true);
        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

        let instance = this;
        xhr.onreadystatechange = () => { // Call a function when the state changes.
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                instance.handleSent();
            };
        };

        xhr.send(JSON.stringify(data));
    }

    // Once sent, change body
    handleSent() {
        document.getElementById('larabug-modal-body').innerHTML = this.success;
    }
}
