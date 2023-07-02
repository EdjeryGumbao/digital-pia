@extends('layouts.sidebar_layout')

@section('title', 'B. Risk Assessment')

@section('content')

<p>Welcome to the Risk Assessment</p>

<p>Welcome to the Privacy Risk Management</p>

<p>For the purpose of this section, a risk refers to the potential of an incident to result in harm or danger 
to a data subject or organization. Risks are those that could lead to the unauthorized collection, use, 
disclosure or access to personal data. It includes risks that the confidentiality, integrity and availability 
of personal data will not be maintained, or the risk that processing will violate rights of data subjects 
or privacy principles (transparency, legitimacy and proportionality).</p>
<p>The first step in managing risks is to identify them, including threats and vulnerabilities, and by 
evaluating its impact and probability</p>
<p>The following definitions are used in this section,</p>
<p>Risk - “the potential for loss, damage or destruction as a result of a threat exploiting a 
vulnerability”;</p>
<p>Threat - “a potential cause of an unwanted incident, which may result in harm to a system or 
organization”;</p>
<p>Vulnerability - “a weakness of an asset or group of assets that can be exploited by one or more 
threats”;</p>
<p>Impact - severity of the injuries that might arise if the event does occur (can be ranked from trivial 
injuries to major injuries); and</p>
<p>Probability - chance or probability of something happening;</p>


           


<table>
<tr>
  <th colspan="3" class="text-center">Impact</th>
</tr>

<tr>
<td>Rating</td>
<td>Types</td>
<td>Description</td>
</tr>

<tr>
<td>1</td>
<td>Negligible</td>
<td>The data subjects will either not be affected or may encounter a few inconveniences, which they will overcome without any problem.</td>
</tr>

<tr>
<td>2</td>
<td>Limited</td>
<td>The data subject may encounter significant inconveniences, which they will be able to overcome despite a few difficulties.</td>
</tr>

<tr>
<td>3</td>
<td>Significant</td>
<td>The data subjects may encounter significant inconveniences, which they should be able to overcome but with serious difficulties.</td>
</tr>

<tr>
<td>4</td>
<td>Maximum</td>
<td>The data subjects may encounter significant inconveniences, or even irreversible, consequences, which they may not overcome.</td>
</tr>

</table>

<br>

<table>
<tr>
  <th colspan="3" class="text-center">Probability</th>
</tr>

<tr>
<td>Rating</td>
<td>Types</td>
<td>Description</td>
</tr>


<tr>
<td>1</td>
<td>Unlikely</td>
<td>Not expected, but there is a slight possibility it may occur at some time.</td>
</tr>

<tr>
<td>2</td>
<td>Possible</td>
<td>Casual occurrence. It might happen at some time.</td>
</tr>

<tr>
<td>3</td>
<td>Likely</td>
<td>Frequent occurrence. There is a strong possibility that it might occur.</td>
</tr>

<tr>
<td>4</td>
<td>Almost Certain</td>
<td>Very likely. It is expected to occur in most circumstances.</td>
</tr>

</table>
      <p>Select the appropriate level or criteria of impact and probability to better assess the risk. Kindly refer to the table below for the criteria.</p>
      <p>Note: Try to itemize your risks by designating a reference number. This will be used as a basis on the next sections (VII. Recommended Privacy Solutions and VIII. Sign off and Action Plan). Also, base the risks on the violation of privacy principles, rights of data subjects and confidentiality, integrity and availability of personal data</p>
      


            <table>
                <tr>
                  <th colspan="12" class="text-center">Probability</th>
                </tr>
                <tr>
                  <td>Ref#</td>
                  <td>Threts/ Vulnerabilities</td>
                  <td colspan="4">Impact</td>
                  <td colspan="4">Probability </td>
                  <td colspan="2">Risk Rating</td>
                </tr>


                <tr>
                  <td></td>
                  <td></td>

                  <td>1</td>
                  <td>2</td>
                  <td>3</td>
                  <td>4</td>


                  <td>1</td>
                  <td>2</td>
                  <td>3</td>
                  <td>4</td>

                  <td></td>
                  <td></td>

                </tr>

                <tr>
                  <td></td>
                  <td></td>

                  <td>1</td>
                  <td>2</td>
                  <td>3</td>
                  <td>4</td>


                  <td>1</td>
                  <td>2</td>
                  <td>3</td>
                  <td>4</td>

                  <td></td>
                  <td></td>

                </tr>
                <tr>
                  <td></td>
                  <td></td>

                  <td>1</td>
                  <td>2</td>
                  <td>3</td>
                  <td>4</td>


                  <td>1</td>
                  <td>2</td>
                  <td>3</td>
                  <td>4</td>

                  <td></td>
                  <td></td>

                </tr>
                <tr>
                  <td></td>
                  <td></td>

                  <td>1</td>
                  <td>2</td>
                  <td>3</td>
                  <td>4</td>


                  <td>1</td>
                  <td>2</td>
                  <td>3</td>
                  <td>4</td>

                  <td></td>
                  <td></td>

                </tr>
            </table>

    
      <p>Kindly follow the formula below for getting the Risk Rating:</p>
      <p>Risk Rating = Impact x Probability</p>
      <p>Kindly refer to the table below for the criteria.</p>


            <table>

                <tr>
                  <th>Rating</th>
                  <th>Types</th>
                </tr>


                <tr>
                  <td>1</td>
                  <td>Negligible</td>
                </tr>

                <tr>
                  <td>2 to 4</td>
                  <td>Low Risk</td>
                </tr>

                <tr>
                  <td>6 to 9</td>
                  <td>Medium Risk</td>
                </tr>

                <tr>
                  <td>10 - 16</td>
                  <td>High Risk</td>
                </tr>


            </table>


      <p>NPC PRIVACY TOOLKIT</p>

      <img src="img/NPC PTK.png" alt="Image Description" width="600" height="500" class="rounded mx-auto d-block">

<form>
  <div class="card card-primary">
    <div class="card-header">
    <h3 class="card-title">Risk Assessment</h3>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-8">
          <label>Threat/Vulnerability</label>
          <input type="text" class="form-control">
        </div>
        <div class="col-2">
        <label>Impact</label>
        <input type="text" class="form-control">
        </div>
        <div class="col-2">
        <label>Probability</label>
        <input type="text" class="form-control">
        </div>
      </div>
    </div>
    <!-- /.card-body -->
    <button type="submit" class="btn btn-success">Add</button>
  </div>
</form>

<form action="proceed_to_flowchart" method="post">
    @csrf
        <div class="card card-primary">
            <table>
                <tr>
                    <th>Threat/Vulnerability</th>
                    <th>Impact</th>
                    <th>Probability</th>
                    <th>Risk</th>
                </tr>
                <tr>
                </tr>
            </table>
        </div>
      <button type="submit" class="btn btn-primary">Next</button>
</form>
@stop