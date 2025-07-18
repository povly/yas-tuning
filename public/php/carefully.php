<div class="modal order-detail-modal active" id="order-modal-carefully" onclick="document.getElementById('order-modal-carefully').remove();document.body.style.overflow='';">
  <div class="modal__table" onclick="document.getElementById('order-modal-carefully').remove();document.body.style.overflow='';">
    <div class="modal__ceil">
      <div class="modal__content order-detail-modal__content" onclick="event.stopPropagation()">
        <button class="order-detail-modal__close modal__close" onclick="document.getElementById('order-modal-carefully').remove();document.body.style.overflow='';">
          <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2.38562 0.392716L8 6.0071L13.5853 0.421806C13.7087 0.290489 13.8573 0.185441 14.0222 0.11296C14.1872 0.0404785 14.3651 0.00205717 14.5453 0C14.931 0 15.301 0.153242 15.5737 0.426014C15.8465 0.698786 15.9998 1.06874 15.9998 1.4545C16.0032 1.63283 15.9701 1.80996 15.9025 1.97504C15.835 2.14012 15.7345 2.28966 15.607 2.41447L9.94903 7.99976L15.607 13.6578C15.8468 13.8923 15.9873 14.2099 15.9998 14.545C15.9998 14.9308 15.8465 15.3007 15.5737 15.5735C15.301 15.8463 14.931 15.9995 14.5453 15.9995C14.3599 16.0072 14.1749 15.9763 14.0022 15.9087C13.8294 15.8411 13.6726 15.7383 13.5417 15.6068L8 9.99243L2.40017 15.5923C2.27727 15.7192 2.13045 15.8205 1.96818 15.8904C1.80591 15.9603 1.63141 15.9974 1.45474 15.9995C1.06898 15.9995 0.699023 15.8463 0.42625 15.5735C0.153478 15.3007 0.000236657 14.9308 0.000236657 14.545C-0.00315451 14.3667 0.0299309 14.1896 0.0974628 14.0245C0.164995 13.8594 0.265548 13.7099 0.392952 13.5851L6.05097 7.99976L0.392952 2.34175C0.153228 2.10722 0.0126576 1.78964 0.000236657 1.4545C0.000236657 1.06874 0.153478 0.698786 0.42625 0.426014C0.699023 0.153242 1.06898 0 1.45474 0C1.80382 0.00436351 2.13836 0.14545 2.38562 0.392716Z" fill="#999999" />
          </svg>
        </button>

        <div class="order-detail-modal__table">

          <!-- Предупреждения -->
          <div class="order-detail-modal__warnings">
            <div class="order-detail-modal__warning">
              <div class="order-detail-modal__warning-icon">
                <svg width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0 19.5C0 14.3283 2.05446 9.36838 5.71142 5.71142C9.36838 2.05446 14.3283 0 19.5 0C24.6717 0 29.6316 2.05446 33.2886 5.71142C36.9455 9.36838 39 14.3283 39 19.5C39 24.6717 36.9455 29.6316 33.2886 33.2886C29.6316 36.9455 24.6717 39 19.5 39C14.3283 39 9.36838 36.9455 5.71142 33.2886C2.05446 29.6316 0 24.6717 0 19.5ZM17.0625 21.9375H21.9375V9.75H17.0625V21.9375ZM21.9375 26.8125C21.9375 26.166 21.6807 25.546 21.2236 25.0889C20.7665 24.6318 20.1465 24.375 19.5 24.375C18.8535 24.375 18.2335 24.6318 17.7764 25.0889C17.3193 25.546 17.0625 26.166 17.0625 26.8125C17.0625 27.459 17.3193 28.079 17.7764 28.5361C18.2335 28.9932 18.8535 29.25 19.5 29.25C20.1465 29.25 20.7665 28.9932 21.2236 28.5361C21.6807 28.079 21.9375 27.459 21.9375 26.8125Z" fill="#FF2F00" />
                </svg>
              </div>
              <div class="order-detail-modal__warning-text">
                Please select this option only if you really need to recovery all changes to original. In case if your attached file after our checking content original changes, order will be completed and the
              </div>
            </div>

            <div class="order-detail-modal__warning">
              <div class="order-detail-modal__warning-icon">
                <svg width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0 19.5C0 14.3283 2.05446 9.36838 5.71142 5.71142C9.36838 2.05446 14.3283 0 19.5 0C24.6717 0 29.6316 2.05446 33.2886 5.71142C36.9455 9.36838 39 14.3283 39 19.5C39 24.6717 36.9455 29.6316 33.2886 33.2886C29.6316 36.9455 24.6717 39 19.5 39C14.3283 39 9.36838 36.9455 5.71142 33.2886C2.05446 29.6316 0 24.6717 0 19.5ZM17.0625 21.9375H21.9375V9.75H17.0625V21.9375ZM21.9375 26.8125C21.9375 26.166 21.6807 25.546 21.2236 25.0889C20.7665 24.6318 20.1465 24.375 19.5 24.375C18.8535 24.375 18.2335 24.6318 17.7764 25.0889C17.3193 25.546 17.0625 26.166 17.0625 26.8125C17.0625 27.459 17.3193 28.079 17.7764 28.5361C18.2335 28.9932 18.8535 29.25 19.5 29.25C20.1465 29.25 20.7665 28.9932 21.2236 28.5361C21.6807 28.079 21.9375 27.459 21.9375 26.8125Z" fill="#FF2F00" />
                </svg>
              </div>
              <div class="order-detail-modal__warning-text">
                Please select this option only if you really need to recovery all changes to original. In case if your attached file after our checking content original changes, order will be completed and the
              </div>
            </div>

            <div class="order-detail-modal__warning">
              <div class="order-detail-modal__warning-icon">
                <svg width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0 19.5C0 14.3283 2.05446 9.36838 5.71142 5.71142C9.36838 2.05446 14.3283 0 19.5 0C24.6717 0 29.6316 2.05446 33.2886 5.71142C36.9455 9.36838 39 14.3283 39 19.5C39 24.6717 36.9455 29.6316 33.2886 33.2886C29.6316 36.9455 24.6717 39 19.5 39C14.3283 39 9.36838 36.9455 5.71142 33.2886C2.05446 29.6316 0 24.6717 0 19.5ZM17.0625 21.9375H21.9375V9.75H17.0625V21.9375ZM21.9375 26.8125C21.9375 26.166 21.6807 25.546 21.2236 25.0889C20.7665 24.6318 20.1465 24.375 19.5 24.375C18.8535 24.375 18.2335 24.6318 17.7764 25.0889C17.3193 25.546 17.0625 26.166 17.0625 26.8125C17.0625 27.459 17.3193 28.079 17.7764 28.5361C18.2335 28.9932 18.8535 29.25 19.5 29.25C20.1465 29.25 20.7665 28.9932 21.2236 28.5361C21.6807 28.079 21.9375 27.459 21.9375 26.8125Z" fill="#FF2F00" />
                </svg>
              </div>
              <div class="order-detail-modal__warning-text">
                Please select this option only if you really need to recovery all changes to original. In case if your attached file after our checking content original changes, order will be completed and the
              </div>
            </div>

            <div class="order-detail-modal__warning">
              <div class="order-detail-modal__warning-icon">
                <svg width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0 19.5C0 14.3283 2.05446 9.36838 5.71142 5.71142C9.36838 2.05446 14.3283 0 19.5 0C24.6717 0 29.6316 2.05446 33.2886 5.71142C36.9455 9.36838 39 14.3283 39 19.5C39 24.6717 36.9455 29.6316 33.2886 33.2886C29.6316 36.9455 24.6717 39 19.5 39C14.3283 39 9.36838 36.9455 5.71142 33.2886C2.05446 29.6316 0 24.6717 0 19.5ZM17.0625 21.9375H21.9375V9.75H17.0625V21.9375ZM21.9375 26.8125C21.9375 26.166 21.6807 25.546 21.2236 25.0889C20.7665 24.6318 20.1465 24.375 19.5 24.375C18.8535 24.375 18.2335 24.6318 17.7764 25.0889C17.3193 25.546 17.0625 26.166 17.0625 26.8125C17.0625 27.459 17.3193 28.079 17.7764 28.5361C18.2335 28.9932 18.8535 29.25 19.5 29.25C20.1465 29.25 20.7665 28.9932 21.2236 28.5361C21.6807 28.079 21.9375 27.459 21.9375 26.8125Z" fill="#FF2F00" />
                </svg>
              </div>
              <div class="order-detail-modal__warning-text">
                Please select this option only if you really need to recovery all changes to original. In case if your attached file after our checking content original changes, order will be completed and the
              </div>
            </div>

            <div class="order-detail-modal__warning">
              <div class="order-detail-modal__warning-icon">
                <svg width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0 19.5C0 14.3283 2.05446 9.36838 5.71142 5.71142C9.36838 2.05446 14.3283 0 19.5 0C24.6717 0 29.6316 2.05446 33.2886 5.71142C36.9455 9.36838 39 14.3283 39 19.5C39 24.6717 36.9455 29.6316 33.2886 33.2886C29.6316 36.9455 24.6717 39 19.5 39C14.3283 39 9.36838 36.9455 5.71142 33.2886C2.05446 29.6316 0 24.6717 0 19.5ZM17.0625 21.9375H21.9375V9.75H17.0625V21.9375ZM21.9375 26.8125C21.9375 26.166 21.6807 25.546 21.2236 25.0889C20.7665 24.6318 20.1465 24.375 19.5 24.375C18.8535 24.375 18.2335 24.6318 17.7764 25.0889C17.3193 25.546 17.0625 26.166 17.0625 26.8125C17.0625 27.459 17.3193 28.079 17.7764 28.5361C18.2335 28.9932 18.8535 29.25 19.5 29.25C20.1465 29.25 20.7665 28.9932 21.2236 28.5361C21.6807 28.079 21.9375 27.459 21.9375 26.8125Z" fill="#FF2F00" />
                </svg>
              </div>
              <div class="order-detail-modal__warning-text">
                Please select this option only if you really need to recovery all changes to original. In case if your attached file after our checking content original changes, order will be completed and the
              </div>
            </div>

            <div class="order-detail-modal__warning">
              <div class="order-detail-modal__warning-icon">
                <svg width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0 19.5C0 14.3283 2.05446 9.36838 5.71142 5.71142C9.36838 2.05446 14.3283 0 19.5 0C24.6717 0 29.6316 2.05446 33.2886 5.71142C36.9455 9.36838 39 14.3283 39 19.5C39 24.6717 36.9455 29.6316 33.2886 33.2886C29.6316 36.9455 24.6717 39 19.5 39C14.3283 39 9.36838 36.9455 5.71142 33.2886C2.05446 29.6316 0 24.6717 0 19.5ZM17.0625 21.9375H21.9375V9.75H17.0625V21.9375ZM21.9375 26.8125C21.9375 26.166 21.6807 25.546 21.2236 25.0889C20.7665 24.6318 20.1465 24.375 19.5 24.375C18.8535 24.375 18.2335 24.6318 17.7764 25.0889C17.3193 25.546 17.0625 26.166 17.0625 26.8125C17.0625 27.459 17.3193 28.079 17.7764 28.5361C18.2335 28.9932 18.8535 29.25 19.5 29.25C20.1465 29.25 20.7665 28.9932 21.2236 28.5361C21.6807 28.079 21.9375 27.459 21.9375 26.8125Z" fill="#FF2F00" />
                </svg>
              </div>
              <div class="order-detail-modal__warning-text">
                Please select this option only if you really need to recovery all changes to original. In case if your attached file after our checking content original changes, order will be completed and the
              </div>
            </div>

            <div class="order-detail-modal__warning">
              <div class="order-detail-modal__warning-icon">
                <svg width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0 19.5C0 14.3283 2.05446 9.36838 5.71142 5.71142C9.36838 2.05446 14.3283 0 19.5 0C24.6717 0 29.6316 2.05446 33.2886 5.71142C36.9455 9.36838 39 14.3283 39 19.5C39 24.6717 36.9455 29.6316 33.2886 33.2886C29.6316 36.9455 24.6717 39 19.5 39C14.3283 39 9.36838 36.9455 5.71142 33.2886C2.05446 29.6316 0 24.6717 0 19.5ZM17.0625 21.9375H21.9375V9.75H17.0625V21.9375ZM21.9375 26.8125C21.9375 26.166 21.6807 25.546 21.2236 25.0889C20.7665 24.6318 20.1465 24.375 19.5 24.375C18.8535 24.375 18.2335 24.6318 17.7764 25.0889C17.3193 25.546 17.0625 26.166 17.0625 26.8125C17.0625 27.459 17.3193 28.079 17.7764 28.5361C18.2335 28.9932 18.8535 29.25 19.5 29.25C20.1465 29.25 20.7665 28.9932 21.2236 28.5361C21.6807 28.079 21.9375 27.459 21.9375 26.8125Z" fill="#FF2F00" />
                </svg>
              </div>
              <div class="order-detail-modal__warning-text">
                Please select this option only if you really need to recovery all changes to original. In case if your attached file after our checking content original changes, order will be completed and the
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
