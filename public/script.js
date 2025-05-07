document.addEventListener("DOMContentLoaded", () => {
    const tabBtns = document.querySelectorAll(".tab-btn")
    const individualSection = document.getElementById("individualSection")
    const groupSection = document.getElementById("groupSection")
    const addNameBtn = document.getElementById("addNameBtn")
    const namesContainer = document.querySelector(".names-container")
    const form = document.getElementById("guestBookForm")
    const formTypeInput = document.getElementById("formType")
    const successModal = document.getElementById("successModal")
    const closeModalBtn = document.getElementById("closeModal")
    const successAlert = document.querySelector(".success-alert")
    const individualNameInput = document.getElementById("individualName");

    if (successAlert) {
        setTimeout(() => {
            successAlert.style.opacity = "0"
            setTimeout(() => {
                successAlert.style.display = "none"
            }, 500)
        }, 5000)
    }

    tabBtns.forEach((btn) => {
        btn.addEventListener("click", function () {
            tabBtns.forEach((b) => b.classList.remove("active"))

            this.classList.add("active")

            formTypeInput.value = this.dataset.type
            console.log("Form type changed to:", this.dataset.type)

            if (this.dataset.type === "individual") {
                individualSection.classList.add("active")
                groupSection.classList.remove("active")
                individualNameInput.value = "";
            } else {
                individualSection.classList.remove("active")
                groupSection.classList.add("active")
            }
        })
    })

    addNameBtn.addEventListener("click", () => {
        const currentNameFields = namesContainer.querySelectorAll(".group-name");
        if (currentNameFields.length >= 10) {
            alert("Maximum 10 names allowed.");
            return;
        }
        
        const nameField = document.createElement("div")
        nameField.className = "form-group"
        nameField.innerHTML = `
              <input type="text" class="group-name" name="nama[]" placeholder="Nama">
              <span class="error-message">Please enter a name</span>
              <button type="button" class="remove-name-btn">×</button>
          `

        const removeBtn = nameField.querySelector(".remove-name-btn")
        removeBtn.style.position = "absolute"
        removeBtn.style.right = "10px"
        removeBtn.style.top = "50%"
        removeBtn.style.transform = "translateY(-50%)"
        removeBtn.style.background = "none"
        removeBtn.style.border = "none"
        removeBtn.style.color = "#ff6b6b"
        removeBtn.style.fontSize = "1.5rem"
        removeBtn.style.cursor = "pointer"

        removeBtn.addEventListener("click", () => {
            nameField.remove()
        })

        namesContainer.appendChild(nameField)

        nameField.style.opacity = "0"
        nameField.style.transform = "translateY(20px)"

        void nameField.offsetWidth

        nameField.style.transition = "all 0.3s ease"
        nameField.style.opacity = "1"
        nameField.style.transform = "translateY(0)"

        const newInput = nameField.querySelector("input")
        newInput.focus()

        namesContainer.scrollTop = namesContainer.scrollHeight
    })

    form.addEventListener("submit", (e) => {
        let isValid = true

        const instansi = document.getElementById("instansi")
        if (!instansi.value.trim()) {
            showError(instansi)
            isValid = false
        } else {
            hideError(instansi)
        }

        const isIndividual = document.querySelector('.tab-btn[data-type="individual"]').classList.contains("active")

        if (isIndividual) {
            const individualName = document.getElementById("individualName")
            if (!individualName.value.trim()) {
                showError(individualName)
            } else {
                hideError(individualName)
            }
        } else {
            const groupNames = document.querySelectorAll(".group-name")
            if (groupNames.length === 0) {
                const emptyNameField = document.createElement("input")
                emptyNameField.type = "hidden"
                emptyNameField.name = "nama[]"
                emptyNameField.value = ""
                form.appendChild(emptyNameField)
            } else {
                groupNames.forEach((input) => {
                    if (!input.value.trim()) {
                        showError(input)
                        isValid = false
                    } else {
                        hideError(input)
                    }
                })
            }
        }

        if (!isValid) {
            e.preventDefault() 
        } else {
            const submitBtn = document.querySelector(".submit-btn")
            submitBtn.innerHTML = "<span>Processing...</span>"
            submitBtn.disabled = true
            submitBtn.style.opacity = "0.7"
        }
    })

    function showError(input) {
        const errorMessage = input.nextElementSibling
        input.style.borderColor = "#ff6b6b"
        errorMessage.style.display = "block"
    }

    function hideError(input) {
        const errorMessage = input.nextElementSibling
        input.style.borderColor = "rgba(255, 255, 255, 0.2)"
        errorMessage.style.display = "none"
    }

    closeModalBtn.addEventListener("click", () => {
        successModal.style.display = "none"
    })

    const buttons = document.querySelectorAll("button")
    buttons.forEach((button) => {
        button.addEventListener("mouseenter", function () {
            if (this.disabled) return
            this.style.transition = "all 0.3s ease"
            this.style.transform = "translateY(-3px)"
            if (!this.classList.contains("tab-btn") || !this.classList.contains("active")) {
                this.style.boxShadow = "0 5px 15px rgba(212, 175, 55, 0.4)"
            }
        })

        button.addEventListener("mouseleave", function () {
            if (this.disabled) return
            this.style.transform = "translateY(0)"
            this.style.boxShadow = "none"
        })
    })
})