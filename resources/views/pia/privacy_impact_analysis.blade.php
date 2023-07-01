@extends('layouts.sidebar_layout')

@section('title', 'Privacy Impact Analysis')

@section('content')

@if($value == 1)
    <p>Welcome to the Privacy Impact Analysis</p>
    <p>Each program, project or means for collecting personal information should be tested for consistency with the following Data Privacy Principles (as identified in Rule IV, Implementing Rules and Regulations of Republic Act No. 10173, known as the “Data Privacy Act of 2012”). Respond accordingly with the questions by checking either the “Yes” or “No” column and/or listing the what the questions may indicate.</p>

    <table>
        <!-- Transparency -->
        <tr>
            <th>Transparency</th>
            <th>Yes</th>
            <th>No</th>
            <th>Not Applicable</th>
        </tr>
        <tr>
            <td>1. Are data subjects aware of the nature, purpose, and extent of the processing of his or her personal data?</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>2. Are data subjects aware of the risks and safeguards involved in the processing of his or her personal data?</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>
                3. Are data subjects aware of his or her rights as a data subject and how these can be exercised?
                
                <ul>
                    Below are the rights of the data subjects:
                    <ul>
                        <li>Right to be informed</li>
                        <li>Right to object</li>
                        <li>Right to access</li>
                        <li>Right to correct</li>
                        <li>Right for erasure or blocking</li>
                        <li>Right to file a complaint</li>
                        <li>Right to damages</li>
                        <li>Right to data portability</li>
                    </ul>
                </ul>

            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>
                Is there a document available for public review that sets out the policies for the management of personal data? 
                <ul>
                    Please identify document(s) and provide link where available:
                </ul>
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Are there steps in place to allow an individual to know what personal data it holds about them and its purpose of collection, usage, and disclosure?</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Are the data subjects aware of the identity of the personal information controller or the organization/entity processing their personal data?</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Are the data subjects provided information about how to contact the organization’s Data Protection Officer (DPO)?</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <!-- Legitimate Purpose -->
        <tr>
            <th>Legitimate Purpose</th>
            <th>Yes</th>
            <th>No</th>
            <th>Not Applicable</th>
        </tr>
        <tr>
            <td>Is the processing of personal data compatible with a declared and specified purpose which is not contrary to law, morals, or public policy?</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Is the processing of personal data authorized by a specific law or regulation, or by the individual through express consent?</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <!-- Proportionality -->
        <tr>
            <th>Proportionality</th>
            <th>Yes</th>
            <th>No</th>
            <th>Not Applicable</th>
        </tr>
        <tr>
            <td>Is the processing of personal data adequate, relevant, suitable, necessary and not excessive in relation to a declared and specified purpose?</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Is the processing of personal data necessary to fulfill the purpose of the processing and no other means are available?</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <!-- Collection -->
        <tr>
            <th>Collection</th>
            <th>Yes</th>
            <th>No</th>
            <th>Not Applicable</th>
        </tr>
        <tr>
            <td>Is the collection of personal data for a declared, specified and legitimate purpose?</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>
                Is individual consent secured prior to the collection and processing of personal data?
                <ul>
                    If no, specify the reason.
                </ul>
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Is consent time-bound in relation to the declared, specified and legitimate purpose?</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Can consent be withdrawn?</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Are all the personal data collected necessary for the program?</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Are the personal data anonymized or de-identified?</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Is the collection of personal data directly from the individual?</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Is there authority for collecting personal data about the individual from other sources?</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Is it necessary to assign or collect a unique identifier to individuals to enable your organization to carry out the program?</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Is it necessary to collect a unique identifier of another agency? e.g. SSS number, PhilHealth, TIN, Pag-IBIG, etc.</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <!-- Use and Disclosure -->
        <tr>
            <th>Use and Disclosure</th>
            <th>Yes</th>
            <th>No</th>
            <th>Not Applicable</th>
        </tr>
        <tr>
            <td>Will Personal data only be used or disclosed for the primary purpose?</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Are the uses and disclosures of personal data for a secondary purpose authorized by law or the individual?</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <!-- Data Quality -->
        <tr>
            <th>Data Quality</th>
            <th>Yes</th>
            <th>No</th>
            <th>Not Applicable</th>
        </tr>
        <tr>
            <th>Please identify all steps taken to ensure that all data that is collected, used or disclosed will be accurate, complete and up to date:</throw>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr>
            <td>Please identify all steps taken to ensure that all data that is collected, used or disclosed will be accurate, complete and up to date:</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>The system is regularly tested for accuracy</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Periodic reviews of the information</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>A disposal schedule in place that deletes information that is over the retention period</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Staff are trained in the use of the tools and receive periodic updates</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Reviews of audit trails are undertaken regularly</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Independent oversight</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Incidents are reviewed for lessons learnt and systems/processes updated appropriately</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Others, please specify</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <!-- Data Security -->
        <tr>
            <th>Data Security</th>
            <th>Yes</th>
            <th>No</th>
            <th>Not Applicable</th>
        </tr>
        <tr>
            <td>
                Do you have appropriate and reasonable organizational, physical and technical security measures in place?
                <ul>
                    <em>organizational measures - refer to the system’s environment, particularly to the individuals carrying them out. Implementing 
                        the organizational data protection policies aim to maintain the availability, integrity, and confidentiality of personal data 
                        against any accidental or unlawful processing (i.e. access control policy, employee training, surveillance, etc.,) physical 
                        measures – refers to policies and procedures shall be implemented to monitor and limit access to and activities in the room, 
                        workstation or facility, including guidelines that specify the proper use of and access to electronic media (i.e. locks, backup 
                        protection, workstation protection, etc.,) technical measures - involves the technological aspect of security in protecting personal 
                        information (i.e. encryption, data center policies, data transfer policies, etc.,)</em>
                </ul>
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <!-- Organizational Security -->
        <tr>
            <th>Organizational Security</th>
            <th>Yes</th>
            <th>No</th>
            <th>Not Applicable</th>
        </tr>
        <tr>
            <td>Have you appointed a data protection officer or compliance officer?</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Are there any data protection and security measure policies in place?</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Do you have an inventory of processing systems? Will you include this project/system?</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Are the users/staffs that will process personal data through this project/system under strict confidentiality if the personal data are not intended for public disclosure?</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>If the processing is delegated to a Personal Information Processor, have you reviewed the contract with the personal information processor?</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <!-- Physical Security -->
        <tr>
            <th>Physical Security</th>
            <th>Yes</th>
            <th>No</th>
            <th>Not Applicable</th>
        </tr>
        <tr>
            <td>Are there policies and procedures to monitor and limit the access to this project/system?</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Are the duties, responsibilities, and schedule of the individuals that will handle the personal data processing clearly defined?</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Do you have an inventory of processing systems? Will you include this project/system?</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <!-- Technical Security -->
        <tr>
            <th>Technical Security</th>
            <th>Yes</th>
            <th>No</th>
            <th>Not Applicable</th>
        </tr>
        <tr>
            <td>Is there a security policy with respect to the processing of personal data?</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Do you have policies and procedures to restore the availability and access to personal data when an incident happens?</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Do/Will you regularly test, assess, and evaluate the effectiveness of the security measures of this project/system?</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Are the personal data processed by this project/system encrypted while in transit or at rest?</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <!-- Disposal -->
        <tr>
            <th>Disposal</th>
            <th>Yes</th>
            <th>No</th>
            <th>Not Applicable</th>
        </tr>
        <tr>
            <td>
                The program will take reasonable steps to destroy or de-identify personal data if it is no longer needed for any purpose.
                <ul>
                    If YES, please list the steps 
                </ul>
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <!-- Cross-border Data Flows -->
        <tr>
            <th>Cross-border Data Flows (optional)</th>
            <th>Yes</th>
            <th>No</th>
            <th>Not Applicable</th>
        </tr>
        <tr>
            <td>
                The program will transfer personal data to an organization or person outside of the Philippines.
                <ul>
                    If YES, please list the steps 
                </ul>
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>
                Personal data will only be transferred to someone outside of the Philippines if any of the following apply:
                <ol type="a">
                    <li>The individual consents to the transfer</li>
                    <li>The organization reasonably believes that the recipient is subject to laws or a contract enforcing information 
                        handling principles substantially similar to the DPA of 2012</li>
                    <li>The transfer is necessary for the performance of a contract between the individual and the organization</li>
                    <li>The transfer is necessary as part of a contract in the interest of the individual between the organization and a third party</li>
                    <li>The transfer is for the benefit of the individual;</li>
                </ol>
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>The organization has taken reasonable steps so that the information transferred will be stored, used, disclosed and otherwise processed consistently with the DPA of 2012 If YES, please describe</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>


    <form action="proceed_to_privacy_risk_management" method="post">
        @csrf
        <button type="submit" class="btn btn-primary" value="1" name="value">Proceed</button>
    </form>

@else
    <p>You have to agree.</p>
    <a href="{{ url('system_description') }}" class="btn btn-primary">Start Again</a>
@endif

@stop