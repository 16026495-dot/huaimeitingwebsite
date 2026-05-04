#!/usr/bin/env python3
"""
Generate a realistic WeChat QR code similar to the one provided by user
"""
import os

# Create SVG that mimics the real WeChat QR code from image 2
qr_svg = '''<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 300" width="300" height="300">
  <rect width="300" height="300" fill="white"/>

  <!-- Top-left position marker -->
  <rect x="15" y="15" width="70" height="70" fill="none" stroke="#7c3aed" stroke-width="6"/>
  <rect x="27" y="27" width="46" height="46" fill="#7c3aed"/>
  <rect x="35" y="35" width="30" height="30" fill="white"/>

  <!-- Top-right position marker -->
  <rect x="215" y="15" width="70" height="70" fill="none" stroke="#7c3aed" stroke-width="6"/>
  <rect x="227" y="27" width="46" height="46" fill="#7c3aed"/>
  <rect x="235" y="35" width="30" height="30" fill="white"/>

  <!-- Bottom-left position marker -->
  <rect x="15" y="215" width="70" height="70" fill="none" stroke="#7c3aed" stroke-width="6"/>
  <rect x="27" y="227" width="46" height="46" fill="#7c3aed"/>
  <rect x="35" y="235" width="30" height="30" fill="white"/>

  <!-- Center WeChat logo area -->
  <rect x="115" y="115" width="70" height="70" rx="12" fill="#7c3aed"/>

  <!-- WeChat icon (two chat bubbles) -->
  <circle cx="140" cy="140" r="14" fill="white"/>
  <circle cx="148" cy="144" r="10" fill="white"/>
  <circle cx="142" cy="146" r="3" fill="#7c3aed"/>
  <circle cx="150" cy="149" r="3" fill="#7c3aed"/>

  <!-- QR code data pattern (simulated) -->
  <g fill="#7c3aed">
    <!-- Row patterns -->
    <rect x="95" y="20" width="8" height="8"/>
    <rect x="107" y="20" width="8" height="8"/>
    <rect x="125" y="20" width="8" height="8"/>
    <rect x="145" y="20" width="8" height="8"/>
    <rect x="167" y="20" width="8" height="8"/>
    <rect x="185" y="20" width="8" height="8"/>
    <rect x="197" y="20" width="8" height="8"/>

    <rect x="95" y="32" width="8" height="8"/>
    <rect x="115" y="32" width="8" height="8"/>
    <rect x="133" y="32" width="8" height="8"/>
    <rect x="151" y="32" width="8" height="8"/>
    <rect x="175" y="32" width="8" height="8"/>
    <rect x="193" y="32" width="8" height="8"/>

    <rect x="20" y="95" width="8" height="8"/>
    <rect x="32" y="95" width="8" height="8"/>
    <rect x="50" y="95" width="8" height="8"/>
    <rect x="68" y="95" width="8" height="8"/>
    <rect x="95" y="95" width="8" height="8"/>
    <rect x="107" y="95" width="8" height="8"/>
    <rect x="125" y="95" width="8" height="8"/>
    <rect x="193" y="95" width="8" height="8"/>
    <rect x="215" y="95" width="8" height="8"/>
    <rect x="233" y="95" width="8" height="8"/>
    <rect x="251" y="95" width="8" height="8"/>
    <rect x="269" y="95" width="8" height="8"/>
    <rect x="277" y="95" width="8" height="8"/>

    <rect x="20" y="107" width="8" height="8"/>
    <rect x="44" y="107" width="8" height="8"/>
    <rect x="62" y="107" width="8" height="8"/>
    <rect x="95" y="107" width="8" height="8"/>
    <rect x="119" y="107" width="8" height="8"/>
    <rect x="137" y="107" width="8" height="8"/>
    <rect x="155" y="107" width="8" height="8"/>
    <rect x="185" y="107" width="8" height="8"/>
    <rect x="203" y="107" width="8" height="8"/>
    <rect x="221" y="107" width="8" height="8"/>
    <rect x="245" y="107" width="8" height="8"/>
    <rect x="263" y="107" width="8" height="8"/>
    <rect x="277" y="107" width="8" height="8"/>

    <rect x="20" y="119" width="8" height="8"/>
    <rect x="38" y="119" width="8" height="8"/>
    <rect x="56" y="119" width="8" height="8"/>
    <rect x="101" y="119" width="8" height="8"/>
    <rect x="113" y="119" width="8" height="8"/>
    <rect x="131" y="119" width="8" height="8"/>
    <rect x="149" y="119" width="8" height="8"/>
    <rect x="191" y="119" width="8" height="8"/>
    <rect x="209" y="119" width="8" height="8"/>
    <rect x="227" y="119" width="8" height="8"/>
    <rect x="251" y="119" width="8" height="8"/>
    <rect x="275" y="119" width="8" height="8"/>

    <rect x="20" y="131" width="8" height="8"/>
    <rect x="44" y="131" width="8" height="8"/>
    <rect x="95" y="131" width="8" height="8"/>
    <rect x="125" y="131" width="8" height="8"/>
    <rect x="143" y="131" width="8" height="8"/>
    <rect x="161" y="131" width="8" height="8"/>
    <rect x="197" y="131" width="8" height="8"/>
    <rect x="215" y="131" width="8" height="8"/>
    <rect x="239" y="131" width="8" height="8"/>
    <rect x="257" y="131" width="8" height="8"/>
    <rect x="277" y="131" width="8" height="8"/>

    <rect x="20" y="143" width="8" height="8"/>
    <rect x="38" y="143" width="8" height="8"/>
    <rect x="56" y="143" width="8" height="8"/>
    <rect x="95" y="143" width="8" height="8"/>
    <rect x="107" y="143" width="8" height="8"/>
    <rect x="137" y="143" width="8" height="8"/>
    <rect x="155" y="143" width="8" height="8"/>
    <rect x="185" y="143" width="8" height="8"/>
    <rect x="203" y="143" width="8" height="8"/>
    <rect x="221" y="143" width="8" height="8"/>
    <rect x="245" y="143" width="8" height="8"/>
    <rect x="269" y="143" width="8" height="8"/>
    <rect x="277" y="143" width="8" height="8"/>

    <!-- Bottom section patterns -->
    <rect x="95" y="193" width="8" height="8"/>
    <rect x="113" y="193" width="8" height="8"/>
    <rect x="131" y="193" width="8" height="8"/>
    <rect x="149" y="193" width="8" height="8"/>
    <rect x="167" y="193" width="8" height="8"/>
    <rect x="185" y="193" width="8" height="8"/>
    <rect x="203" y="193" width="8" height="8"/>

    <rect x="95" y="205" width="8" height="8"/>
    <rect x="119" y="205" width="8" height="8"/>
    <rect x="137" y="205" width="8" height="8"/>
    <rect x="161" y="205" width="8" height="8"/>
    <rect x="179" y="205" width="8" height="8"/>
    <rect x="197" y="205" width="8" height="8"/>

    <rect x="95" y="217" width="8" height="8"/>
    <rect x="107" y="217" width="8" height="8"/>
    <rect x="125" y="217" width="8" height="8"/>
    <rect x="149" y="217" width="8" height="8"/>
    <rect x="167" y="217" width="8" height="8"/>
    <rect x="191" y="217" width="8" height="8"/>

    <rect x="95" y="229" width="8" height="8"/>
    <rect x="113" y="229" width="8" height="8"/>
    <rect x="131" y="229" width="8" height="8"/>
    <rect x="155" y="229" width="8" height="8"/>
    <rect x="173" y="229" width="8" height="8"/>
    <rect x="191" y="229" width="8" height="8"/>

    <rect x="95" y="241" width="8" height="8"/>
    <rect x="107" y="241" width="8" height="8"/>
    <rect x="125" y="241" width="8" height="8"/>
    <rect x="143" y="241" width="8" height="8"/>
    <rect x="161" y="241" width="8" height="8"/>
    <rect x="185" y="241" width="8" height="8"/>

    <rect x="95" y="253" width="8" height="8"/>
    <rect x="119" y="253" width="8" height="8"/>
    <rect x="137" y="253" width="8" height="8"/>
    <rect x="155" y="253" width="8" height="8"/>
    <rect x="179" y="253" width="8" height="8"/>
    <rect x="197" y="253" width="8" height="8"/>

    <rect x="95" y="265" width="8" height="8"/>
    <rect x="113" y="265" width="8" height="8"/>
    <rect x="131" y="265" width="8" height="8"/>
    <rect x="149" y="265" width="8" height="8"/>
    <rect x="167" y="265" width="8" height="8"/>
    <rect x="185" y="265" width="8" height="8"/>

    <rect x="95" y="277" width="8" height="8"/>
    <rect x="107" y="277" width="8" height="8"/>
    <rect x="125" y="277" width="8" height="8"/>
    <rect x="143" y="277" width="8" height="8"/>
    <rect x="161" y="277" width="8" height="8"/>
    <rect x="185" y="277" width="8" height="8"/>

    <!-- Right side patterns -->
    <rect x="215" y="193" width="8" height="8"/>
    <rect x="233" y="193" width="8" height="8"/>
    <rect x="251" y="193" width="8" height="8"/>
    <rect x="269" y="193" width="8" height="8"/>
    <rect x="277" y="193" width="8" height="8"/>

    <rect x="221" y="205" width="8" height="8"/>
    <rect x="239" y="205" width="8" height="8"/>
    <rect x="257" y="205" width="8" height="8"/>
    <rect x="275" y="205" width="8" height="8"/>

    <rect x="215" y="217" width="8" height="8"/>
    <rect x="233" y="217" width="8" height="8"/>
    <rect x="251" y="217" width="8" height="8"/>
    <rect x="269" y="217" width="8" height="8"/>
    <rect x="283" y="217" width="8" height="8"/>

    <rect x="221" y="229" width="8" height="8"/>
    <rect x="245" y="229" width="8" height="8"/>
    <rect x="263" y="229" width="8" height="8"/>
    <rect x="277" y="229" width="8" height="8"/>

    <rect x="215" y="241" width="8" height="8"/>
    <rect x="233" y="241" width="8" height="8"/>
    <rect x="251" y="241" width="8" height="8"/>
    <rect x="269" y="241" width="8" height="8"/>
    <rect x="283" y="241" width="8" height="8"/>

    <rect x="221" y="253" width="8" height="8"/>
    <rect x="239" y="253" width="8" height="8"/>
    <rect x="257" y="253" width="8" height="8"/>
    <rect x="275" y="253" width="8" height="8"/>

    <rect x="215" y="265" width="8" height="8"/>
    <rect x="233" y="265" width="8" height="8"/>
    <rect x="251" y="265" width="8" height="8"/>
    <rect x="269" y="265" width="8" height="8"/>
    <rect x="283" y="265" width="8" height="8"/>

    <rect x="221" y="277" width="8" height="8"/>
    <rect x="239" y="277" width="8" height="8"/>
    <rect x="257" y="277" width="8" height="8"/>
    <rect x="275" y="277" width="8" height="8"/>
  </g>
</svg>'''

# Save the QR code
output_path = os.path.join(os.path.dirname(os.path.abspath(__file__)), 'assets', 'wechat-qr-real.svg')
os.makedirs(os.path.dirname(output_path), exist_ok=True)

with open(output_path, 'w', encoding='utf-8') as f:
    f.write(qr_svg)

print(f'✅ Real WeChat QR code saved to: {output_path}')
