<form class="user__set-priority-abs" hx-post="/php/superadmin/priority.php" hx-on:htmx:before-request="if(event.target.classList.contains('user__set-priority-abs')){this.closest('.user__set-priority').classList.toggle('active');}" hx-target="this" hx-swap="outerHTML">
  <div class="user__set-priority-close" onclick="this.closest('.user__set-priority').classList.remove('active');"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M2.38562 0.392716L8 6.0071L13.5853 0.421806C13.7087 0.290489 13.8573 0.185441 14.0222 0.11296C14.1872 0.0404786 14.3651 0.00205717 14.5453 0C14.931 0 15.301 0.153242 15.5737 0.426014C15.8465 0.698786 15.9998 1.06874 15.9998 1.4545C16.0032 1.63283 15.9701 1.80996 15.9025 1.97504C15.835 2.14012 15.7345 2.28966 15.607 2.41447L9.94903 7.99976L15.607 13.6578C15.8468 13.8923 15.9873 14.2099 15.9998 14.545C15.9998 14.9308 15.8465 15.3007 15.5737 15.5735C15.301 15.8463 14.931 15.9995 14.5453 15.9995C14.3599 16.0072 14.1749 15.9763 14.0022 15.9087C13.8294 15.8411 13.6726 15.7383 13.5417 15.6068L8 9.99243L2.40017 15.5923C2.27727 15.7192 2.13045 15.8205 1.96818 15.8904C1.80591 15.9603 1.63141 15.9974 1.45474 15.9995C1.06898 15.9995 0.699023 15.8463 0.42625 15.5735C0.153478 15.3007 0.000236657 14.9308 0.000236657 14.545C-0.00315451 14.3667 0.0299309 14.1896 0.0974628 14.0245C0.164995 13.8594 0.265548 13.7099 0.392952 13.5851L6.05097 7.99976L0.392952 2.34175C0.153228 2.10722 0.0126576 1.78964 0.000236657 1.4545C0.000236657 1.06874 0.153478 0.698786 0.42625 0.426014C0.699023 0.153242 1.06898 0 1.45474 0C1.80382 0.00436351 2.13836 0.14545 2.38562 0.392716Z" fill="#999999"></path>
    </svg>
  </div>
  <div class="user__set-priority-items">
    <div class="user__set-priority-item">
      <div class="user__set-priority-square"></div>
      <div class="user__set-priority-title"><span>1-2 hours</span></div>
      <div class="user__set-priority-price"><span>+20%</span></div>
      <div class="user__set-priority-edit" hx-post="/php/superadmin/priority-edit.php" hx-target="closest .user__set-priority-item" hx-vals="{&quot;id&quot;: &quot;2&quot;}"><svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M1 13.75C0.7875 13.75 0.6095 13.678 0.466 13.534C0.3225 13.39 0.2505 13.212 0.25 13V11.1813C0.25 10.9813 0.2875 10.7905 0.3625 10.609C0.4375 10.4275 0.54375 10.2682 0.68125 10.1312L10.15 0.68125C10.3 0.54375 10.4658 0.4375 10.6473 0.3625C10.8288 0.2875 11.0192 0.25 11.2188 0.25C11.4183 0.25 11.612 0.2875 11.8 0.3625C11.988 0.4375 12.1505 0.55 12.2875 0.7L13.3187 1.75C13.4687 1.8875 13.578 2.05 13.6465 2.2375C13.715 2.425 13.7495 2.6125 13.75 2.8C13.75 3 13.7155 3.19075 13.6465 3.37225C13.5775 3.55375 13.4682 3.71925 13.3187 3.86875L3.86875 13.3187C3.73125 13.4562 3.57175 13.5625 3.39025 13.6375C3.20875 13.7125 3.01825 13.75 2.81875 13.75H1ZM11.2 3.85L12.25 2.8L11.2 1.75L10.15 2.8L11.2 3.85Z" fill="#F5F5F5"></path>
        </svg>
        <input type="hidden" name="priority__price" value="20">
        <input type="hidden" name="priority__title" value="1-2 hours">
      </div>
    </div>
    <div class="user__set-priority-item">
      <div class="user__set-priority-square"></div>
      <div class="user__set-priority-title">
        <input type="hidden" name="priority__title" value="2-4 hours"><span>2-4 hours</span>
      </div>
      <div class="user__set-priority-price">
        <input type="hidden" name="priority__price" value="10"><span>+10%</span>
      </div>
      <div class="user__set-priority-edit" hx-post="/php/superadmin/priority-edit.php" hx-target="closest .user__set-priority-item" hx-vals="{&quot;id&quot;: &quot;22&quot;}"><svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M1 13.75C0.7875 13.75 0.6095 13.678 0.466 13.534C0.3225 13.39 0.2505 13.212 0.25 13V11.1813C0.25 10.9813 0.2875 10.7905 0.3625 10.609C0.4375 10.4275 0.54375 10.2682 0.68125 10.1312L10.15 0.68125C10.3 0.54375 10.4658 0.4375 10.6473 0.3625C10.8288 0.2875 11.0192 0.25 11.2188 0.25C11.4183 0.25 11.612 0.2875 11.8 0.3625C11.988 0.4375 12.1505 0.55 12.2875 0.7L13.3187 1.75C13.4687 1.8875 13.578 2.05 13.6465 2.2375C13.715 2.425 13.7495 2.6125 13.75 2.8C13.75 3 13.7155 3.19075 13.6465 3.37225C13.5775 3.55375 13.4682 3.71925 13.3187 3.86875L3.86875 13.3187C3.73125 13.4562 3.57175 13.5625 3.39025 13.6375C3.20875 13.7125 3.01825 13.75 2.81875 13.75H1ZM11.2 3.85L12.25 2.8L11.2 1.75L10.15 2.8L11.2 3.85Z" fill="#F5F5F5"></path>
        </svg>
      </div>
    </div>
    <div class="user__set-priority-item">
      <div class="user__set-priority-square"></div>
      <div class="user__set-priority-title">
        <input type="hidden" name="priority__title" value="12-14 hours"><span>12-14 hours</span>
      </div>
      <div class="user__set-priority-price">
        <input type="hidden" name="priority__price" value="-10"><span>-10%</span>
      </div>
      <div class="user__set-priority-edit" hx-post="/php/superadmin/priority-edit.php" hx-target="closest .user__set-priority-item" hx-vals="{&quot;id&quot;: &quot;22&quot;}"><svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M1 13.75C0.7875 13.75 0.6095 13.678 0.466 13.534C0.3225 13.39 0.2505 13.212 0.25 13V11.1813C0.25 10.9813 0.2875 10.7905 0.3625 10.609C0.4375 10.4275 0.54375 10.2682 0.68125 10.1312L10.15 0.68125C10.3 0.54375 10.4658 0.4375 10.6473 0.3625C10.8288 0.2875 11.0192 0.25 11.2188 0.25C11.4183 0.25 11.612 0.2875 11.8 0.3625C11.988 0.4375 12.1505 0.55 12.2875 0.7L13.3187 1.75C13.4687 1.8875 13.578 2.05 13.6465 2.2375C13.715 2.425 13.7495 2.6125 13.75 2.8C13.75 3 13.7155 3.19075 13.6465 3.37225C13.5775 3.55375 13.4682 3.71925 13.3187 3.86875L3.86875 13.3187C3.73125 13.4562 3.57175 13.5625 3.39025 13.6375C3.20875 13.7125 3.01825 13.75 2.81875 13.75H1ZM11.2 3.85L12.25 2.8L11.2 1.75L10.15 2.8L11.2 3.85Z" fill="#F5F5F5"></path>
        </svg>
      </div>
    </div>
  </div>
  <button class="user__set-priority-save p-btn p-btn_orange p-btn_center" type="submit">Save</button>
</form>
